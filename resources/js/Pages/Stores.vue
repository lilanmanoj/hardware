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
                    {{ items }}

                    <table class="border-collapse border border-black-800">
                        <thead>
                            <tr>
                                <th class="border border-grey-600 py-2 px-3">Name</th>
                                <th class="border border-grey-600 py-2 px-3">Address</th>
                                <th class="border border-grey-600 py-2 px-3">Phone</th>
                                <th class="border border-grey-600 py-2 px-3">Status</th>
                                <th class="border border-grey-600 py-2 px-3">Action</th>
                            </tr>
                        </thead>

                        <tbody v-if="items.data.length > 0">
                            <tr v-for="item in items.data" :key="item.id">
                                <td class="border border-grey-600 py-1 px-3">{{ item.name }}</td>
                                <td class="border border-grey-600 py-1 px-3">{{ item.address }}</td>
                                <td class="border border-grey-600 py-1 px-3">{{ item.fixed_no }}</td>
                                <td class="border border-grey-600 py-1 px-3">{{ item.mobile_no }}</td>
                                <td class="border border-grey-600 py-1 px-3"></td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td class="border border-grey-600 py-1 px-3" colspan="5">No records to show.</td>
                            </tr>
                        </tbody>
                    </table>
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
        props: {
            items: Array,
        }
    }
</script>
