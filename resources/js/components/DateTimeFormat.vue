<script>
import moment from 'moment';

export default {
    props: {
        time: {
            type: String,
            required: true,
        },
        format: {
            type: String,
            default: 'YYYY-MM-DD HH:mm:ss',
        },
    },
    computed: {
        formattedTime() {
            return moment(this.time).format(this.format);
        },
    },
};
</script>

<!-- TimeFormat.vue -->
<template>
    {{ formattedTime }}
</template>
