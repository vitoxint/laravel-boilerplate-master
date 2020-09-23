
let eventGuid = 0
let todayStr = new Date().toISOString().replace(/T.*$/, '') // YYYY-MM-DD of today
let eventos = []

axios.get( "get_calendario_ot").then((response) => {
    console.log(response.data.data);
     eventos =response.data.data;
   
})			
.catch(function (error) {
    this.output = error;
    alert(error)
});


export const INITIAL_EVENTS = eventos
/* [
  {
    id: createEventId(),
    title: 'All-day event',
    start: todayStr
  },
  {
    id: createEventId(),
    title: 'Timed event',
    start: todayStr + 'T12:00:00',
    end  : '2020-08-30'
  }
] */

export function createEventId() {
  return String(eventGuid++)
}