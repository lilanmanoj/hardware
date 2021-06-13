<template>
    <div class="mx-auto border-collapse my-4 w-full lg:w-1/2" v-bind="$attrs">
        <div class="grid grid-cols-2 mb-4" v-for="data in processedOpeningHours" :key="data.day">
            <div class="px-3 py-1 font-medium text-black ">{{ data.day }}</div>

            <div class="px-3 py-1 text-left bg-gray-200 rounded-md font-semibold text-black">
                {{ data.comment }}
            </div>
        </div>
    </div>
</template>

<script>
    import { map, padStart } from 'lodash';

    function getTime(dt) {
        let time = null;

        if (dt != null) {
            const datetime = new Date(dt);
            time = _.padStart(datetime.getHours(), 2, "0") + ":" + _.padStart(datetime.getMinutes(), 2, "0");
        }

        return time;
    }

    export default {
        props: {
            openingHours: {
                type: Array,
                default() {
                    return [];
                }
            }
        },
        computed: {
            processedOpeningHours() {
                let processedArr = [];

                if (this.openingHours.length > 0) {
                    processedArr = _.map(this.openingHours, this.process)
                }

                return processedArr;
            }
        },
        methods: {
            process(row) {
                const day = row.day;
                let comment = "N/A";
                let open_at = getTime(row.open_at);
                let close_at = getTime(row.close_at);

                if (row.full_day_open === true) comment = "Open full day";
                if (row.full_day_close === true) comment = "Closed full day";
                if (open_at != null && close_at != null) comment = "Open from " + open_at + " to " + close_at;
                if (open_at != null && close_at == null) comment = "Open at " + open_at;
                if (open_at == null && close_at != null) comment = "close at " + close_at;

                return { 
                    day: day,
                    comment: comment
                }
            }
        }
    }
</script>
