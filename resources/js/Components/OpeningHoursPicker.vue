<template>
    <table class="mx-auto border-collapse my-4">
        <thead class="border-b border-gray-300">
            <th class="text-left p-3">Day</th>
            <th class="text-left p-3">Open 24 Hours</th>
            <th class="text-left p-3">Closed Full Day</th>
            <th class="text-left p-3">Open Time</th>
            <th class="text-left p-3">Close Time</th>
        </thead>

        <tbody>
            <tr v-for="data in opening_hours" :key="data.day">
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
</template>

<script>
    export default {
        data() {
            return {
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
        },
        methods: {
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
            }
        }
    }
</script>
