import Map from "ol/Map.js";
import View from "ol/View.js";
import { Tile as TileLayer } from "ol/layer.js";
import OSM from "ol/source/OSM.js";
import Overlay from "ol/Overlay.js";
import TileWMS from "ol/source/TileWMS.js";

document.addEventListener("alpine:init", () => {
  Alpine.data("map", function () {
    return {
      legendOpened: false,
      map: {},
      activeTab: "legend",
      initComponent() {
        let terreLayer = new TileLayer({
          source: new TileWMS({
            url: "http://localhost:8081/geoserver/wms",
            params: {
              LAYERS: "laravelgis:anosizato_planet_osm_polygon_polygons",
              TILED: true,
              STYLES: "",
            },
            serverType: "geoserver",
          }),
          label: "Terre",
        });

        let batiLayer = new TileLayer({
          source: new TileWMS({
            url: "http://localhost:8081/geoserver/wms",
            params: {
              LAYERS: "laravelgis:anosizato_planet_osm_point_points",
              TILED: true,
              STYLES: "",
            },
            serverType: "geoserver",
          }),
          label: "Bâtiments",
        });

        let routeLayer = new TileLayer({
          source: new TileWMS({
            url: "http://localhost:8081/geoserver/wms",
            params: {
              LAYERS: "laravelgis:anosizato_planet_osm_line_lines",
              TILED: true,
              STYLES: "",
            },
            serverType: "geoserver",
          }),
          label: "Routes",
        });

        this.map = new Map({
          target: this.$refs.map,
          layers: [
            new TileLayer({
              source: new OSM(),
              label: "OpenStreetMap",
            }),
            terreLayer,
            batiLayer,
            routeLayer,
          ],
          view: new View({
            projection: "EPSG:4326",
            center: [47.49820, -18.93820],
            zoom: 15,
          }),
          overlays: [
            new Overlay({
              id: "info",
              element: this.$refs.popup,
              stopEvent: true,
            }),
          ],
        });

        // * OnClick Event
        this.map.on("singleclick", (event) => {
          if (event.dragging) {
            return;
          }

          let overlay = this.map.getOverlayById("info");
          overlay.setPosition(undefined);
          this.$refs.popupContent.innerHTML = "";

          const viewResolution = /** @type {number} */ (
            event.map.getView().getResolution()
          );

          // * onclick batiments
          const url_bati = batiLayer
            .getSource()
            .getFeatureInfoUrl(event.coordinate, viewResolution, "EPSG:4326", {
              INFO_FORMAT: "application/json",
            });

          if (url_bati) {
            fetch(url_bati)
              .then((response) => response.json())
              .then((json) => {
                if (json.features.length > 0) {
                  let jsonFeature = json.features[0].properties;

                  console.log(jsonFeature);

                  let content =
                    "<div class='space-y-5'>" +
                    '<h4 class="text-gray-500 font-bold">Nom du batiment : ' +
                    jsonFeature.name +
                    "</h4>" +
                    '<h4 class="text-gray-500 font-bold">Type de batiment : ' +
                    jsonFeature.natural +
                    "</h4>" +
                    "</div>";

                  this.$refs.popupContent.innerHTML = content;

                  console.log(event.coordinate);

                  setTimeout(() => {
                    overlay.setPosition(event.coordinate);
                  }, 500);

                  return;
                }
              });
          }
        });
      },
      closePopup() {
        let overlay = this.map.getOverlayById("info");
        overlay.setPosition(undefined);
        this.$refs.popupContent.innerHTML = "";
      },
      infoBatiModal(jsonFeature) {
        let overlay = this.map.getOverlayById("info");
        overlay.setPosition(undefined);
        this.$refs.popupContent.innerHTML = "";

        let content =
          "<div class='space-y-5'>" +
          '<h4 class="text-gray-500 font-bold">Nom du batiment : ' +
          jsonFeature.properties.name +
          "</h4>" +
          '<h4 class="text-gray-500 font-bold">Type de batiment : ' +
          jsonFeature.properties.operator +
          "</h4>" +
          "</div>";

        this.$refs.popupContent.innerHTML = content;

        setTimeout(() => {
          overlay.setPosition(jsonFeature.geometry.coordinates[0][0]);
        }, 500);

        return;
      },
      hasLegend(layer) {
        return layer.getSource() instanceof TileWMS;
      },
      legendUrl(layer) {
        if (this.hasLegend(layer)) {
          return layer
            .getSource()
            .getLegendUrl(this.map.getView().getResolution(), {
              LEGEND_OPTIONS: "forceLabels:on",
            });
        }
      },
    };
  });
});
