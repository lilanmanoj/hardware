<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add New Store
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <el-form ref="form" :model="form" label-width="160px">
                        <el-collapse v-model="expanded">

                            <el-collapse-item name="general_details">
                                <template #title>
                                    <h2><i class="el-icon-tickets"></i> General Details</h2>
                                </template>

                                <el-form-item label="Code">
                                    <el-input placeholder="Enter store code" name="code" v-model="form.code"></el-input>
                                </el-form-item>

                                <el-form-item label="Name">
                                    <el-input placeholder="Enter store name" name="name" v-model="form.name"></el-input>
                                </el-form-item>

                                <el-form-item label="Description">
                                    <el-input type="textarea" :rows="2" placeholder="Enter additional information" name="description" v-model="form.description"></el-input>
                                </el-form-item>

                                <el-form-item label="Address">
                                    <el-input type="textarea" :rows="2" placeholder="Enter store address" name="address" v-model="form.address"></el-input>
                                </el-form-item>

                                <el-form-item label="Phone No (Fixed)">
                                    <el-input placeholder="Enter fixed no" name="fixed_no" v-model="form.fixed_no"></el-input>
                                </el-form-item>

                                <el-form-item label="Phone No (Mobile)">
                                    <el-input placeholder="Enter mobile no" name="mobile_no" v-model="form.mobile_no"></el-input>
                                </el-form-item>

                                <el-form-item label="Fax No">
                                    <el-input placeholder="Enter fax no" name="fax_no" v-model="form.fax_no"></el-input>
                                </el-form-item>

                                <el-form-item label="Email">
                                    <el-input placeholder="Enter email" name="email" v-model="form.email"></el-input>
                                </el-form-item>

                                <el-form-item label="BR No">
                                    <el-input placeholder="Enter BR no" name="br_no" v-model="form.br_no"></el-input>
                                </el-form-item>
                            </el-collapse-item>
                            
                            <el-collapse-item name="location_info">
                                <template #title>
                                    <h2><i class="el-icon-map-location"></i> Location/Regional Information</h2>
                                </template>

                                <div class="mx-auto overflow-hidden w-full lg:w-3/4 mt-4 py-2">
                                    <el-form-item label="District">
                                        <el-select v-model="form.district_id" placeholder="Select district" class="w-full">
                                            <el-option
                                                v-for="district in districts"
                                                :key="district.id"
                                                :label="district.name"
                                                :value="district.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item label="Area">
                                        <el-input placeholder="Select area" v-model="form.area_id"></el-input>
                                        <!-- <el-select v-model="form.area_id" placeholder="Select area">
                                            <el-option
                                                v-for="district in districts"
                                                :key="district.id"
                                                :label="district.name"
                                                :value="district.id">
                                            </el-option>
                                        </el-select> -->
                                    </el-form-item>
                                </div>

                                <div class="mx-auto overflow-hidden w-full lg:w-3/4 my-4 py-2">
                                    <input ref="placesAutocomplete" type="text" placeholder="Search place" class="w-full">
                                </div>

                                <li class="mx-auto overflow-hidden block w-auto list-none bg-blue-200 lg:w-3/4 my-4 pt-1 px-4 shadow rounded-full">
                                    <i class="el-icon-info"></i> Click <strong>on map</strong> to place marker (<i class="el-icon-location-information"></i>) to mark the store location!
                                </li>

                                <div ref="map" class="mx-auto overflow-hidden w-full lg:w-3/4 h-80 rounded border border-gray-400"></div>

                                <div class="mx-auto overflow-hidden w-full lg:w-3/4 my-2 text-center md:text-right">
                                    <el-button type="danger" icon="el-icon-delete-location" @click="clearMarkers">Remove Markers</el-button>
                                </div>
                            </el-collapse-item>
                        
                            <el-collapse-item name="opening_hours">
                                <template #title>
                                    <h2><i class="el-icon-alarm-clock"></i> Opening Hours</h2>
                                </template>

                                <table class="mx-auto border-collapse my-4">
                                    <thead class="border-b border-gray-300">
                                        <th class="text-left p-3">Day</th>
                                        <th class="text-left p-3">Open 24 Hours</th>
                                        <th class="text-left p-3">Closed Full Day</th>
                                        <th class="text-left p-3">Open Time</th>
                                        <th class="text-left p-3">Close Time</th>
                                    </thead>

                                    <tbody>
                                        <tr v-for="data in form.opening_hours" :key="data.day">
                                            <td class="px-3 py-1">{{ data.day }}</td>
                                            <td class="px-3 py-1 text-center">
                                                <el-switch
                                                    v-model="data.full_day_open"
                                                    @change="changedFullDayOpen(data)">
                                                </el-switch>
                                            </td>
                                            <td class="px-3 py-1 text-center">
                                                <el-switch
                                                    v-model="data.full_day_close"
                                                    @change="changedFullDayClose(data)">
                                                </el-switch>
                                            </td>
                                            <td class="px-3 py-1 text-center">
                                                <el-time-picker
                                                    v-model="data.open_at"
                                                    format="HH:mm"
                                                    :disabled="data.picker_disabled"
                                                    :disabled-seconds="disabledSeconds"
                                                    placeholder="Open time">
                                                </el-time-picker>
                                            </td>
                                            <td class="px-3 py-1 text-center">
                                                <el-time-picker
                                                    v-model="data.close_at"
                                                    format='HH:mm'
                                                    :disabled="data.picker_disabled"
                                                    :disabled-seconds="disabledSeconds"
                                                    placeholder="Close time">
                                                </el-time-picker>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <el-form-item label="Notes">
                                    <el-input type="textarea" :rows="2" placeholder="Enter special notes" name="notes" v-model="form.special_notes"></el-input>
                                </el-form-item>
                            </el-collapse-item>
                            
                        </el-collapse>

                        <div class="mt-5 flex justify-between overflow-hidden">
                            <el-button type="warning" @click="cancel"><i class="el-icon-close el-icon-left text-red-500"></i> Cancel</el-button>
                            <el-button type="primary" @click="submit"><i class="el-icon-check el-icon-left text-green-300"></i> Create</el-button>
                        </div>
                    </el-form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import { Loader } from '@googlemaps/js-api-loader';
    
    const googleMapApiKey = "AIzaSyA_T-I_mtlxGDS3qSewjGWoz4CIG9tN04c";

    const makeRange = (start, end) => {
        const result = [];

        for (let i = start; i <= end; i++) {
            result.push(i);
        }

        return result;
    }
    
    const mapLoader = new Loader({
        apiKey: googleMapApiKey,
        version: 3.43,
        libraries: ["places"]
    });

    let $map;
    let $markers = [];

    export default {
        components: {
            AppLayout
        },
        props: {
            districts: Object
        },
        data() {
            return {
                expanded: [ 'general_details', 'opening_hours' ],
                place: null,
                form: {
                    code: '',
                    name: '',
                    description: '',
                    address: '',
                    fixed_no: '',
                    mobile_no: '',
                    fax_no: '',
                    email: '',
                    br_no: '',
                    special_notes: '',
                    district_id: null,
                    area_id: null,
                    latitude: null,
                    longitude: null,
                    opening_hours: [
                        {
                            'day': "Monday",
                            'full_day_open': false,
                            "full_day_close": false,
                            "picker_disabled": false,
                            "open_at": null,
                            "close_at": null
                        },
                        {
                            'day': "Tuesday",
                            'full_day_open': false,
                            "full_day_close": false,
                            "picker_disabled": false,
                            "open_at": null,
                            "close_at": null
                        },
                        {
                            'day': "Wednesday",
                            'full_day_open': false,
                            "full_day_close": false,
                            "picker_disabled": false,
                            "open_at": null,
                            "close_at": null
                        },
                        {
                            'day': "Thursday",
                            'full_day_open': false,
                            "full_day_close": false,
                            "picker_disabled": false,
                            "open_at": null,
                            "close_at": null
                        },
                        {
                            'day': "Friday",
                            'full_day_open': false,
                            "full_day_close": false,
                            "picker_disabled": false,
                            "open_at": null,
                            "close_at": null
                        },
                        {
                            'day': "Saturday",
                            'full_day_open': false,
                            "full_day_close": false,
                            "picker_disabled": false,
                            "open_at": null,
                            "close_at": null
                        },
                        {
                            'day': "Sunday",
                            'full_day_open': false,
                            "full_day_close": false,
                            "picker_disabled": false,
                            "open_at": null,
                            "close_at": null
                        }
                    ]
                }
            }
        },
        methods: {
            disabledSeconds() {
                return makeRange(1, 59);
            },
            changedFullDayOpen(data) {
                data.full_day_close = false;
                data.picker_disabled = data.full_day_open;
                this.resetOpeningHours(data);
            },
            changedFullDayClose(data) {
                data.full_day_open = false;
                data.picker_disabled = data.full_day_close;
                this.resetOpeningHours(data);
            },
            resetOpeningHours(data) {
                data.open_at = null;
                data.close_at = null;
            },
            clearMarkers() {
                // Clear previous marker
                if ($markers.length > 0) {
                    for (let i = 0; i < $markers.length; i++) {
                        $markers[i].setMap(null);
                    }

                    $markers = [];
                }
            },
            submit() {
                this.$inertia.post(route('manage.stores.store'), this.form);
            },
            cancel() {
                this.$inertia.get(route('manage.stores.index'));
            }
        },
        mounted: function () {
            this.$nextTick(function () {
                mapLoader.load().then(() => {
                    $map = new google.maps.Map(this.$refs.map, {
                        center: { lat: 6.8784116, lng: 79.9405166 },
                        zoom: 10
                    });

                    $map.addListener("click", (e) => {
                        $map.setCenter(e.latLng);
                        $map.setZoom(20);

                        this.clearMarkers();

                        // Set new marker
                        const marker = new google.maps.Marker({
                            position: e.latLng,
                            map: $map,
                            title: "Store location"
                        });

                        this.form.latitude = e.latLng.lat();
                        this.form.longitude = e.latLng.lng();

                        $markers.push(marker);
                    });

                    const autocompleteInput = this.$refs.placesAutocomplete;
                    const autocompleteOptions = {
                        fields: ["place_id", "formatted_address", "geometry", "icon", "name"],
                    };

                    const autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);

                    autocomplete.addListener("place_changed", () => {
                        const selectedPlace = autocomplete.getPlace();
                        const selectedPlaceLat = selectedPlace.geometry.location.lat();
                        const selectedPlaceLng = selectedPlace.geometry.location.lng();
                        const selectedPlaceLatLng = new google.maps.LatLng(selectedPlaceLat, selectedPlaceLng);

                        $map.setCenter(selectedPlaceLatLng);
                        $map.setZoom(20);

                        this.clearMarkers();

                        // Set new marker
                        const marker = new google.maps.Marker({
                            position: selectedPlaceLatLng,
                            map: $map,
                            title: "Store location"
                        });

                        this.form.latitude = selectedPlaceLat;
                        this.form.longitude = selectedPlaceLng;

                        $markers.push(marker);
                    });
                });
            });
        }
    }
</script>