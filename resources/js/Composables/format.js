import { ref } from 'vue';
import moment from 'moment';


export function useFormatDate(date){
    return moment(date).format('DD MMM YYYY');
}