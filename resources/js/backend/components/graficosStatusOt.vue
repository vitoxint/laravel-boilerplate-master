<template>
  <div class="small">
    <h4>Cantidad de trabajos segun estado de cumplimiento al {{this.mes}}</h4>
    
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

import LineChart from './LineChartStatusOt.js'

export default {



  data(){
    return {
      datacollection: {},
      url : 'ordenTrabajo/getGraphStatusMes',
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
         let uri = 'ordenTrabajo/getGraphStatusMes';
         let Dias = new Array();
         let Labels = new Array();
         //let NumsI = new Array();
         let NumsSI = new Array();
         let NumsEP = new Array();
         let NumsAT = new Array();
         let NumsTE = new Array();
         let NumsEN = new Array();

        this.gradient = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
        this.gradient2 = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
        this.gradient3 = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
        this.gradient4 = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
        this.gradient5 = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);

        this.gradient.addColorStop(0, "rgba(224, 224,224, 0.95)");
        this.gradient.addColorStop(0.65, "rgba(224, 224, 224, 0.45)");
        this.gradient.addColorStop(1, "rgba(224, 224, 224, 0)");

        this.gradient2.addColorStop(0, "rgba(0, 255, 0, 0.95)");
        this.gradient2.addColorStop(0.65, "rgba(0, 255, 0, 0.45)");
        this.gradient2.addColorStop(1, "rgba(0, 255, 0, 0)");

        this.gradient3.addColorStop(0, "rgba(0, 0, 255, 0.95)");
        this.gradient3.addColorStop(0.65, "rgba(0, 0, 255, 0.45)");
        this.gradient3.addColorStop(1, "rgba(0, 0, 255, 0)");

        this.gradient4.addColorStop(0, "rgba(0, 0, 0, 0.95)");
        this.gradient4.addColorStop(0.65, "rgba(0, 0, 0, 0.45)");
        this.gradient4.addColorStop(1, "rgba(0, 0, 0, 0)");

        this.gradient5.addColorStop(0, "rgba(255, 0, 0, 0.95)");
        this.gradient5.addColorStop(0.65, "rgba(255, 0, 0, 0.45)");
        this.gradient5.addColorStop(1, "rgba(255, 0, 0, 0)");


         axios.get(uri).then((response) => {
            let data = response.data.data;
            this.mes = response.data.mes;

            if(data) {
               data.forEach(element => {
                  Dias.push(element.day);
                  Labels.push(element.day);
                  NumsSI.push(element.otsSI);
                  NumsEP.push(element.otsEP);
                  NumsAT.push(element.otsAT);
                  NumsTE.push(element.otsTE);
                  NumsEN.push(element.otsEN);
               });
               //Chart
               this.datacollection={
               labels: Labels,
               datasets: [
                   {
                        label: 'OTs Sin Iniciar',
                        backgroundColor: this.gradient,
                        data: NumsSI
                    } 
                    ,
                    {
                        label: 'OTs En Proceso',
                        backgroundColor: this.gradient3,
                        data: NumsEP
                    }
                    ,
                    {
                        label: 'OTs Atrasadas',
                        backgroundColor: this.gradient5,
                        data: NumsAT
                    }
                    ,
                    {
                        label: 'OTs Terminadas',
                        backgroundColor: this.gradient2,
                        data: NumsTE
                    }
                    ,
                    {
                        label: 'OTs Entregadas',
                        backgroundColor: this.gradient4,
                        data: NumsEN
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
  max-width: 1200px;
  /* max-height: 500px; */
  margin:  50px auto;
}
</style>