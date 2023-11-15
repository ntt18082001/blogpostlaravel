import moment from 'moment';

export const formatDateTimeMixin = {
    methods: {
        formattedTime(time) {
            const format = 'YYYY-MM-DD HH:mm:ss';
            return moment(time).format(format);
        },
    },
};
