<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View Store
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <el-form ref="form" label-width="160px">
                        <el-collapse v-model="expanded">

                            <el-collapse-item name="general_details">
                                <template #title>
                                    <h2><i class="el-icon-tickets"></i> General Details</h2>
                                </template>

                                <div class="grid grid-cols-1 lg:grid-cols-2 grid-flow-row gap-4">
                                    <el-form-item label="Code" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.code }}</el-form-item>

                                    <el-form-item label="Name" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.name }}</el-form-item>

                                    <el-form-item label="Description" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.description }}</el-form-item>

                                    <el-form-item label="Address" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.address }}</el-form-item>

                                    <el-form-item label="Phone No (Fixed)" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.fixed_no }}</el-form-item>

                                    <el-form-item label="Phone No (Mobile)" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.mobile_no }}</el-form-item>

                                    <el-form-item label="Fax No" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.fax_no }}</el-form-item>

                                    <el-form-item label="Email" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.email }}</el-form-item>

                                    <el-form-item label="BR No" class="bg-gray-200 rounded-md font-semibold text-black">{{ store.br_no }}</el-form-item>
                                </div>
                            </el-collapse-item>
                            
                            <el-collapse-item name="location_info">
                                <template #title>
                                    <h2><i class="el-icon-map-location"></i> Location/Regional Information</h2>
                                </template>

                                <div class="mx-auto overflow-hidden w-full lg:w-3/4 mt-4 py-2 grid grid-cols-1 lg:grid-cols-2 grid-flow-row gap-4">
                                    <el-form-item label="District" class="bg-gray-200 rounded-md font-semibold text-black">{{ (store.district != null) ? store.district.name : "N/A" }}</el-form-item>

                                    <el-form-item label="Area" class="bg-gray-200 rounded-md font-semibold text-black">{{ (store.area != null) ? store.area.name : "N/A" }}</el-form-item>
                                </div>

                                <store-locator 
                                    :latitude="store.latitude"
                                    :longitude="store.longitude"
                                    :mark-center="true"
                                    :searchable="false"
                                    :markable="false"
                                    :removable="false"
                                ></store-locator>
                            </el-collapse-item>
                        
                            <el-collapse-item name="opening_hours">
                                <template #title>
                                    <h2><i class="el-icon-alarm-clock"></i> Opening Hours</h2>
                                </template>

                                <opening-hours-viewer :opening-hours="store.opening_hours"></opening-hours-viewer>

                                <el-form-item label="Notes" class="mt-6 bg-gray-200 rounded-md font-semibold text-black">{{ store.special_notes }}</el-form-item>
                            </el-collapse-item>
                            
                        </el-collapse>

                        <div class="mt-5 flex justify-end overflow-hidden">
                            <el-button type="primary" @click="ok"><i class="el-icon-check el-icon-left text-green-300"></i> Ok</el-button>
                        </div>
                    </el-form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import OpeningHoursViewer from '@/Components/OpeningHoursViewer';
    import StoreLocator from '@/Components/StoreLocator';

    export default {
        components: {
            AppLayout,
            OpeningHoursViewer,
            StoreLocator
        },
        props: {
            store: {
                type: Object,
                default() {
                    return {};
                }
            }
        },
        data() {
            return {
                expanded: [ 'general_details', 'opening_hours' ]
            }
        },
        methods: {
            ok() {
                this.$inertia.get(route('manage.stores.index'));
            }
        }
    }
</script>