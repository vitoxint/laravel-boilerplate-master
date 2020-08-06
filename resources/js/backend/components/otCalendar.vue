 <script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import esLocale from '@fullcalendar/core/locales/es';

export default {
  components: {
    FullCalendar 
  },


  data() {
    
    return {
     
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin ],
        locale: esLocale,
        initialView: 'dayGridMonth',
        dateClick: this.handleDateClick,
        events: []

      }
    }
  },

  created(){
      this.getEvents();
  },
   
  methods: {
    handleDateClick: function(arg) {
      alert('date click! ' + arg.dateStr)
    },

    getEvents() {
        let currentObj = this;
        let ev = [];
      axios
        .get("get_calendario_ot")
        .then(resp => (currentObj.calendarOptions.events = resp.data.data))
        .catch(err => console.log(err.response.data));

        //currentObj.calendarOptions.events = [{ title: 'event 1', date: '2020-08-10' }, { title: 'event 2', date: '2020-08-02' }]
    },



  },
    

}
</script> 

 <template>
    <div id="app">

        {{events}}
        <FullCalendar :options="calendarOptions"  />
        

    </div>

</template>
 
