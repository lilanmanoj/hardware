<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Store
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

                                <div class="grid grid-cols-1 lg:grid-cols-2 grid-flow-row gap-4">
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

                                    <el-form-item label="Status">
                                        <el-select v-model="form.status" placeholder="Select status" class="w-full">
                                            <el-option
                                                v-for="status in states"
                                                :key="status.id"
                                                :label="status.name"
                                                :value="status.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </div>
                            </el-collapse-item>
                            
                            <el-collapse-item name="location_info">
                                <template #title>
                                    <h2><i class="el-icon-map-location"></i> Location/Regional Information</h2>
                                </template>
                                
                                <div class="mx-auto overflow-hidden w-full lg:w-3/4 mt-4 py-2 grid grid-cols-1 lg:grid-cols-2 grid-flow-row gap-4">
                                    <el-form-item label="District">
                                        <el-select v-model="form.district_id" placeholder="Select district" class="w-full" @change="districtChanged">
                                            <el-option
                                                v-for="district in districts"
                                                :key="district.id"
                                                :label="district.name"
                                                :value="district.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>

                                    <el-form-item label="Area">
                                        <el-select v-model="form.area_id" placeholder="Select area" class="w-full">
                                            <el-option
                                                v-for="area in areas"
                                                :key="area.id"
                                                :label="area.name"
                                                :value="area.id">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </div>

                                <store-locator v-model:latitude="form.latitude" v-model:longitude="form.longitude" :mark-center="true"></store-locator>
                            </el-collapse-item>
                        
                            <el-collapse-item name="opening_hours">
                                <template #title>
                                    <h2><i class="el-icon-alarm-clock"></i> Opening Hours</h2>
                                </template>

                                <opening-hours-picker v-model:opening-hours="form.opening_hours"></opening-hours-picker>

                                <el-form-item label="Notes">
                                    <el-input type="textarea" :rows="2" placeholder="Enter special notes" name="notes" v-model="form.special_notes"></el-input>
                                </el-form-item>
                            </el-collapse-item>
                            
                        </el-collapse>

                        <div class="mt-5 flex justify-between overflow-hidden">
                            <el-button type="warning" @click="cancel"><i class="el-icon-close el-icon-left text-red-500"></i> Cancel</el-button>
                            <el-button type="primary" @click="submit"><i class="el-icon-check el-icon-left text-green-300"></i> Update</el-button>
                        </div>
                    </el-form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import OpeningHoursPicker from '@/Components/OpeningHoursPicker';
    import StoreLocator from '@/Components/StoreLocator';
    import pick from 'lodash/pick';

    export default {
        components: {
            AppLayout,
            OpeningHoursPicker,
            StoreLocator
        },
        props: {
            store: {
                type: Object,
                default() {
                    return {};
                }
            },
            states: {
                type: Object,
                default() {
                    return [];
                }
            },
            districts: {
                type: Object,
                default() {
                    return [];
                }
            },
            areas: {
                type: Object,
                default() {
                    return [];
                }
            }
        },
        data() {
            return {
                expanded: [ 'general_details', 'opening_hours' ],
                form: {
                    code: this.store.code,
                    name: this.store.name,
                    description: this.store.description,
                    address: this.store.address,
                    fixed_no: this.store.fixed_no,
                    mobile_no: this.store.mobile_no,
                    fax_no: this.store.fax_no,
                    email: this.store.email,
                    br_no: this.store.br_no,
                    special_notes: this.store.special_notes,
                    district_id: this.store.district_id,
                    area_id: this.store.area_id,
                    latitude: this.store.latitude,
                    longitude: this.store.longitude,
                    opening_hours: this.store.opening_hours,
                    status: this.store.status
                }
            }
        },
        methods: {
            districtChanged() {
                const district = pick(this.form, 'district_id');
                this.$inertia.get(this.route('manage.stores.edit', this.store.id), district, { replace: true, preserveState: true, preserveScroll: true });
                this.form.area_id = null;
            },
            submit() {
                this.$inertia.put(this.route('manage.stores.update', this.store.id), this.form);
            },
            cancel() {
                this.$inertia.get(route('manage.stores.index'));
            }
        }
    }
</script>