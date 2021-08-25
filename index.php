<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Hello, world!</title>

    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  </head>
  <body>
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4"></div>
        <div class="col-4"></div>
      </div>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
   
  </body>
  <div class="container">
    <center><h1 style="border: 2px solid Violet;">62105077 Nirawan Ausakan</h1></center>
    <div class="row">
      <div class="col-6">
        <canvas id="myChart"width="400" height="200"></canvas>
      </div>

    </div>
    <div class="row">
      <div class="col-6">
        <canvas id="myChart1"width="400" height="200"></canvas>
      </div>

    </div>
    
      <div class="row">
        <div class="col-3">
          <div class="row">
            <div class="col-4">
              <b>Temperature</b>
            </div>
            <div class="col-8">
              <span id="lastTemperature"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <b>Humidity</b>
            </div>
            <div class="col-8">
              <span id="lastHumidity"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-4">update </div>
            <div class="col-8">
              <span id="lastUpdate"></span>
            </div>

          </div>
        </div>
         
      </div>
  </div> 

  <script>
      function loadData(xlabel,data_h,data_t,url){
          //alert("Hello")
        
          $.getJSON(url,function(data){
         
            //console.log(data.channel.name);
            let feeds = data.feeds;
            console.log(feeds[9]);
            $("#lastTemperature").text(feeds[9].field2+" C");
            $("#lastHumidity").text(feeds[9].field1+" %");
            $("#lastUpdate").text(feeds[9].created_at);
              $.each(feeds,(k,v)=>{
                xlabel.push(v.entry_id);
                data_h.push(v.field1);
                data_t.push(v.field2);
    
    
              });
          })
          .fail(function(error){
            console.log(error);
          });
      }
          function showChart(data,xlabel,id,label){
              var ctx = document.getElementById(id).getContext('2d');
              var myChart = new Chart(ctx,{
                type:'line',
                data:{
                  labels:xlabel,
                  datasets:[{
                      label:label,
                      data:data
                    }]
                }
              });
          }
        $(()=>{
          var plot =Object();
          var xlabel=[];
          var data_h=[];
          var data_t=[];
          var id1 ='myChart';
          var id2 ='myChart1';
          var label_h ='Humidity';
          var label_t='Temperature';
          let url="https://api.thingspeak.com/channels/1458420/feeds.json?results=10";

          loadData(xlabel,data_h,data_t,url);
          showChart(data_h,xlabel,id1,label_h);
          showChart(data_t,xlabel,id2,label_t);

        })
         
         
     
      
  </script>
</html>

