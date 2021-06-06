<template>
    <table class="mx-auto border-collapse my-4" v-bind="$attrs">
        <thead class="border-b border-gray-300">
            <th class="text-left p-3">Day</th>
            <th class="text-left p-3">Open 24 Hours</th>
            <th class="text-left p-3">Closed Full Day</th>
            <th class="text-left p-3">Open Time</th>
            <th class="text-left p-3">Close Time</th>
        </thead>

        <tbody>
            <tr v-for="data in updatedOpeningHours" :key="data.day">
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
                        @change="changedOpenTime"
                        format="HH:mm"
                        :disabled="data.picker_disabled"
                        :disabled-seconds="disabledSeconds"
                        placeholder="Open time">
                    </el-time-picker>
                </td>
                <td class="px-3 py-1 text-center">
                    <el-time-picker
                        v-model="data.close_at"
                        @change="changedCloseTime"
                        format='HH:mm'
                        :disabled="data.picker_disabled"
                        :disabled-seconds="disabledSeconds"
                        placeholder="Close time">
                    </el-time-picker>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    const makeRange = (start, end) => {
        const result = [];

        for (let i = start; i <= end; i++) {
            result.push(i);
        }

        return result;
    }

    export default {
        props: {
            openingHours: {
                type: Array,
                default() {
                    return [
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
                    ];
                }
            }
        },
        data() {
            return {
                defaultOpeningHours: [
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
        },
        emits: ['update:openingHours'],
        computed: {
            updatedOpeningHours() {
                return this.openingHours.length > 0 ? this.openingHours : this.defaultOpeningHours;
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
                this.update();
            },
            changedFullDayClose(data) {
                data.full_day_open = false;
                data.picker_disabled = data.full_day_close;
                this.resetOpeningHours(data);
                this.update();
            },
            changedOpenTime() {
                this.update();
            },
            changedCloseTime() {
                this.update();
            },
            resetOpeningHours(data) {
                data.open_at = null;
                data.close_at = null;
            },
            update() {
                this.$emit('update:openingHours', this.updatedOpeningHours);
            }
        }
    }
</script>
