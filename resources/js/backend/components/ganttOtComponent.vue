<template>
  <div id="app">

      <div>
        <p>{{arrayRow}} </p> <p>{{arrayItem}} </p>
      </div>  

    <GSTC :config="config" @state="onState" />

  </div>
</template>

<script>
import GSTC from "vue-gantt-schedule-timeline-calendar";
let subs = [];

export default {
  name: "app",
  components: {
    GSTC
  },
  data() {
    return {

      arrayRow  : {},
      arrayItem : {},
      mes : '',
      output: '',
      etiquetas: {
            1:
            {
              id: "1",
              label: "Row 1"
            },
            "2": {
              id: "2",
              label: "Row 2"
            },
            "3": {
              id: "3",
              label: "Row 3"
            },
            "4": {
              id: "4",
              label: "Row 4"
            }
          },

      config: {
        height: 400,
        locale:{
            name:'es',
            months: ['Enero', 'Febrero' , 'Marzo', 'Abril', 'Mayo' ,'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre' ,'Diciembre'],
            weekdays: ['Domingo' , 'Lunes' , 'Martes' , 'Miercoles', 'Jueves' , 'Viernes' , 'Sábado'  ],
            weekStart: 1,
        },

        list: {
             rows: this.etiquetas,

         /*  rows: {
            1:
            {
              id: "1",
              label: "Row 1"
            },
            "2": {
              id: "2",
              label: "Row 2"
            },
            "3": {
              id: "3",
              label: "Row 3"
            },
            "4": {
              id: "4",
              label: "Row 4"
            }
          },
 */

          columns: {
            data: {
              id: {
                id: "id",
                data: "id",
                width: 95,
                header: {
                  content: "Folio"
                }
              },
              label: {
                id: "label",
                data: "label",
                width: 200,
                header: {
                  content: "Cliente"
                }
              }
            }
          }
        },
        chart: {

          items: {
              //this.arrayItem

            1: {
              id: "1",
              rowId: "1",
              label: "Item 1",
              time: {
                start: new Date('2020-08-15').getTime(),
                end: new Date('2020-08-25').getTime() 
              }
            },
            "2": {
              id: "2",
              rowId: "2",
              label: "Item 2",
              time: {
                start: new Date().getTime() + 4 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 5 * 24 * 60 * 60 * 1000
              }
            },
            "3": {
              id: "3",
              rowId: "2",
              label: "Item 3",
              time: {
                start: new Date().getTime() + 6 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 7 * 24 * 60 * 60 * 1000
              }
            },
            "4": {
              id: "4",
              rowId: "3",
              label: "Item 4",
              time: {
                start: new Date().getTime() + 10 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 12 * 24 * 60 * 60 * 1000
              }
            },
            "5": {
              id: "5",
              rowId: "4",
              label: "Item 5",
              time: {
                start: new Date().getTime() + 12 * 24 * 60 * 60 * 1000,
                end: new Date().getTime() + 14 * 24 * 60 * 60 * 1000
              }
            }


          }
          

        }
      }
    };
  },

  created() {
      let currentObj = this;
      //let loader = currentObj.$loading.show();

      //this.axios.get("http://localhost/maestranza/public/api/productos-venta/lista").then((response) => {
      axios.get("ordenTrabajo/getGanttOtsMes").then((response) => {

      currentObj.arrayRow = response.data.aRow;
      currentObj.arrayItem = response.data.aItem;
      currentObj.mes = response.data.mes;
      })			
      .catch(function (error) {
          currentObj.output = error;
          alert(error)
      });

      //currentObj.etiquetas = 

      //const sweetArray = [2, 3, 4, 5, 35]
/*       let etq = currentObj.arrayItem;

      currentObj.etiquetas = etq.map(item => {
        var it = item.id;
          return { it : {
              'id': item.id,
              'label' : item.label
          }}
      }) */



  },


  methods: {
    onState(state) {
      this.state = state;
/*       subs.push(
        state.subscribe("config.chart.items.1", item => {
          console.log("item 1 changed", item);
        })
      );
      subs.push(
        state.subscribe("config.list.rows.1", row => {
          console.log("row 1 changed", row);
        })
      ); */
    }
  },
  mounted() {
/*     setTimeout(() => {
      const item1 = this.config.chart.items["1"];
      item1.label = "label changed dynamically";
      item1.time.end += 2 * 24 * 60 * 60 * 1000;
    }, 2000); */
  },
  beforeDestroy() {
    subs.forEach(unsub => unsub());
  }

};
</script>