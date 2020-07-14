<template>
  <div class="small">
    <h4>Ratio de ingresos esperables y reales por trabajos abonados y terminados {{this.mes}}</h4>
    
    <canvas
      ref="canvas"
      id="canvas"
      class="bg"
      width="1"
      height="1"></canvas>
    <line-chart :chart-data="datacollection" :height="140"></line-chart>
    
    
  </div>
</template>

<script>

import LineChart from './LineChartIngresos.js'

export default {



  data(){
    return {
      datacollection: {},
      url : 'ordenTrabajo/getChartMonth',
      gradient: null,
      gradient2: null,
      mes : null
     

    }
  }, 
    components: {
    LineChart
  }, 
  created () {
      //this.getData()
  },


  mounted () {

    this.fillData()
        
  },

  methods: {

    fillData ()
    {
         let uri = 'ordenTrabajo/getChartMonthIngresos';
         let Dias = new Array();
         let Labels = new Array();
         let NumsI = new Array();
         let NumsP = new Array();
         let NumsC = new Array();

        this.gradient = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
        this.gradient2 = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);

        this.gradient.addColorStop(0, "rgba(0, 0,255, 0.5)");
        this.gradient.addColorStop(0.5, "rgba(0, 0, 255, 0.25)");
        this.gradient.addColorStop(1, "rgba(0, 0, 255, 0)");

        this.gradient2.addColorStop(0, "rgba(0, 231, 0, 0.9)");
        this.gradient2.addColorStop(0.5, "rgba(0, 231, 0, 0.25)");
        this.gradient2.addColorStop(1, "rgba(0, 231, 0, 0)");

         axios.get(uri).then((response) => {
            let data = response.data.data;
            this.mes = response.data.mes;
            if(data) {
               data.forEach(element => {
               Dias.push(element.day);
               Labels.push(element.day);
               NumsI.push(element.otsI);
               NumsP.push(element.otsP);
               NumsC.push(element.otsC);
               });
               //Chart
               this.datacollection={
               labels: Labels,
               datasets: [
        /*            {
                        label: 'Trabajos iniciados',
                        backgroundColor: this.gradient,
                        data: NumsI
                    } , */
                    {
                        label: 'Ratio Saldos - Ingresos',
                        backgroundColor: this.gradient2,
                        data: NumsC
                    }
                
                ]
         }
       }
       else {
          console.log('No data');
       }
      });
    }
  }


}
</script>

<style lang="css">
.small {
  max-width: 1000px;
  /* max-height: 500px; */
  margin:  50px auto;
}
</style>