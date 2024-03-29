<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Stores
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <!-- {{ items }} -->

                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-start-1">
                            <el-button round type="primary" size="medium" @click="addNew"><i class="el-icon-plus el-icon-left"></i> Add New</el-button>
                        </div>
                        <div class="col-end-7 col-span-2">
                            <el-input
                                placeholder="Search"
                                prefix-icon="el-icon-search"
                                v-model="form.query">
                            </el-input>
                        </div>
                    </div>

                    <el-table
                        class="my-4"
                        :data="items.data"
                        stripe
                        style="width: 100%">
                        <el-table-column
                            prop="code"
                            label="Code"
                            width="160">
                        </el-table-column>
                        <el-table-column
                            prop="name"
                            label="Name"
                            width="200">
                        </el-table-column>
                        <el-table-column
                            prop="address"
                            label="Address">
                        </el-table-column>
                        <el-table-column
                            prop="fixed_no"
                            label="Phone"
                            width="150">
                        </el-table-column>
                        <el-table-column
                            prop="mobile_no"
                            label="Mobile"
                            width="150">
                        </el-table-column>
                        <el-table-column
                            fixed="right"
                            label="Actions"
                            width="120">
                                <template #default="scope">
                                    <el-button round size="small"><i class="el-icon-edit el-icon-left"></i> Edit</el-button>
                                    <el-button type="text" size="small"><i class="el-icon-delete text-red-600"></i></el-button>
                                </template>
                        </el-table-column>
                    </el-table>

                    <div class="flex justify-end">
                        <div class="flex-grow-0">
                            <el-pagination
                                background
                                layout="prev, pager, next"
                                :page-size="items.per_page"
                                :total="items.total"
                                :current-page="items.current_page"
                                @current-change="changePage"
                                @prev-click="prevClicked"
                                @next-click="nextClicked">
                            </el-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import pickBy from 'lodash/pickBy'
    import throttle from 'lodash/throttle'

    export default {
        components: {
            AppLayout
        },
        props: {
            items: Object,
            query: String
        },
        data() {
            return {
                form: {
                    query: this.query
                },
            }
        },
        watch: {
            form: {
                handler: throttle(function() {
                    let query = pickBy(this.form)
                    this.$inertia.get(this.route('manage.stores.index'), query, { replace: true, preserveState: true })
                }, 150),
                deep: true,
            }
        },
        methods: {
            addNew() {
                this.$inertia.get(route('manage.stores.create'));
            },
            changePage(e) {
                this.$inertia.get(route('manage.stores.index'), { page: e, query: this.form.query });
            },
            prevClicked() {
                this.$inertia.get(this.items.prev_page_url);
            },
            nextClicked() {
                this.$inertia.get(this.items.next_page_url);
            }
        }
    }
</script>
