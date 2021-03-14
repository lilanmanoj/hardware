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
                        <el-form-item label="Name">
                            <el-input placeholder="Enter store name" name="name" v-model="form.name"></el-input>
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

                        <el-form-item>
                            <el-button type="warning" @click="cancel"><i class="el-icon-close el-icon-left text-red-500"></i> Cancel</el-button>
                            <el-button type="primary" @click="submit"><i class="el-icon-check el-icon-left text-green-300"></i> Create</el-button>
                        </el-form-item>
                    </el-form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout
        },
        data() {
        return {
            form: {
                name: '',
                address: '',
                fixed_no: '',
                mobile_no: '',
                fax_no: '',
                email: '',
                br_no: ''
            }
        }
        },
        methods: {
            submit() {
                this.$inertia.post(route('manage.stores.store'), this.form);
            },
            cancel() {
                this.$inertia.get(route('manage.stores.index'));
            }
        }
    }
</script>