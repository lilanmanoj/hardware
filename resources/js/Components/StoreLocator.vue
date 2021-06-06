<template>
    <div class="map-container" v-bind="$attrs">
        <div v-if="searchable" class="mx-auto overflow-hidden w-full lg:w-3/4 my-4 py-2">
            <input ref="placesAutocomplete" type="text" placeholder="Search place" class="w-full">
        </div>

        <li v-if="markable" class="mx-auto overflow-hidden block w-auto list-none bg-blue-200 lg:w-3/4 my-4 pt-1 px-4 shadow rounded-full">
            <i class="el-icon-info"></i> Click <strong>on map</strong> to place marker (<i class="el-icon-location-information"></i>) to mark the store location!
        </li>

        <div ref="map" class="mx-auto overflow-hidden w-full lg:w-3/4 h-80 rounded border border-gray-400"></div>

        <div v-if="removable" class="mx-auto overflow-hidden w-full lg:w-3/4 my-2 text-center md:text-right">
            <el-button size="small" type="danger" icon="el-icon-delete-location" @click="clearMarkers" plain>Clear Markers</el-button>
        </div>
    </div>
</template>
<script>
import { Loader } from '@googlemaps/js-api-loader';

const googleMapApiKey = "AIzaSyA_T-I_mtlxGDS3qSewjGWoz4CIG9tN04c";
    
const mapLoader = new Loader({
    apiKey: googleMapApiKey,
    version: 3.43,
    libraries: ["places"]
});

const $defaultZoomLevel = 10;
const $interactiveZoomLevel = 18;
let $map;
let $markers = [];

export default {
    props: {
        latitude: {
            type: Number,
            default() {
                return 6.8784116
            }
        },
        longitude: {
            type: Number,
            default() {
                return 79.9405166
            }
        },
        markCenter: {
            type: Boolean,
            default() {
                return false
            }
        },
        searchable: {
            type: Boolean,
            default() {
                return true
            }
        },
        markable: {
            type: Boolean,
            default() {
                return true
            }
        },
        removable: {
            type: Boolean,
            default() {
                return true
            }
        }
    },
    emits: ['update:latitude', 'update:longitude'],
    data() {
        return {
            defaultLat: 6.8784116,
            defaultLng: 79.9405166,
            updatedLat: this.computedLatitude,
            updatedLng: this.computedLongitude
        }
    },
    computed: {
        computedLatitude() {
            return (this.latitude > 0 && this.latitude != this.defaultLat) ? this.latitude : this.defaultLat;
        },
        computedLongitude() {
            return (this.longitude > 0 && this.longitude != this.defaultLng) ? this.longitude : this.defaultLng;
        }
    },
    methods: {
        clearMarkers() {
            if (this.removable) {
                // Clear previous marker
                if ($markers.length > 0) {
                    for (let i = 0; i < $markers.length; i++) {
                        $markers[i].setMap(null);
                    }

                    $markers = [];
                }

                this.updatedLat = this.updatedLng = null;
                this.update();
            }
        },
        update() {
            this.$emit('update:latitude', this.updatedLat);
            this.$emit('update:longitude', this.updatedLng);
        }
    },
    mounted() {
        this.$nextTick(function () {
            mapLoader.load().then(() => {
                $map = new google.maps.Map(this.$refs.map, {
                    center: { lat: this.computedLatitude, lng: this.computedLongitude },
                    zoom: $defaultZoomLevel
                });

                if (this.markCenter) {
                    $map.setZoom($interactiveZoomLevel);

                    const centerLatLng = new google.maps.LatLng(this.computedLatitude, this.computedLongitude);

                    // Set new marker
                    const marker = new google.maps.Marker({
                        position: centerLatLng,
                        map: $map,
                        title: "Store location!"
                    });

                    $markers.push(marker);
                }

                if (this.markable) {
                    $map.addListener("click", (e) => {
                        $map.setCenter(e.latLng);
                        $map.setZoom($interactiveZoomLevel);

                        this.clearMarkers();

                        // Set new marker
                        const marker = new google.maps.Marker({
                            position: e.latLng,
                            map: $map,
                            title: "Marked location!"
                        });

                        this.updatedLat = e.latLng.lat();
                        this.updatedLng = e.latLng.lng();

                        this.update();

                        $markers.push(marker);
                    });
                }

                const autocompleteInput = this.$refs.placesAutocomplete;
                const autocompleteOptions = {
                    fields: ["place_id", "formatted_address", "geometry", "icon", "name"],
                };

                if (this.searchable) {
                    const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);

                    autocomplete.addListener("place_changed", () => {
                        const selectedPlace = autocomplete.getPlace();
                        const selectedPlaceLat = selectedPlace.geometry.location.lat();
                        const selectedPlaceLng = selectedPlace.geometry.location.lng();
                        const selectedPlaceLatLng = new google.maps.LatLng(selectedPlaceLat, selectedPlaceLng);

                        $map.setCenter(selectedPlaceLatLng);
                        $map.setZoom($interactiveZoomLevel);

                        this.clearMarkers();

                        // Set new marker
                        const marker = new google.maps.Marker({
                            position: selectedPlaceLatLng,
                            map: $map,
                            title: "Searched location!"
                        });

                        this.updatedLat = selectedPlaceLat;
                        this.updatedLng = selectedPlaceLng;

                        this.update();

                        $markers.push(marker);
                    });
                }
            });
        });
    }
}
</script>