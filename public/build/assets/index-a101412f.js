(function(){if($(".stacked-bar-chart-1").length){let a=$(".stacked-bar-chart-1")[0].getContext("2d");new Chart(a,{type:"bar",data:{labels:[...Array(16).keys()],datasets:[{label:"Html Template",barPercentage:.5,barThickness:6,maxBarThickness:8,minBarLength:2,backgroundColor:getColor("primary",.8),data:helper.randomNumbers(-100,100,16)},{label:"VueJs Template",barPercentage:.5,barThickness:6,maxBarThickness:8,minBarLength:2,backgroundColor:$("html").hasClass("dark")?getColor("darkmode.200"):getColor("slate.300"),data:helper.randomNumbers(-100,100,16)}]},options:{maintainAspectRatio:!1,plugins:{legend:{display:!1}},scales:{x:{stacked:!0,ticks:{font:{size:"12"},color:getColor("slate.500",.8)},grid:{display:!1,drawBorder:!1}},y:{stacked:!0,ticks:{font:{size:"12"},color:getColor("slate.500",.8),callback:function(e,r,t){return"$"+e}},grid:{color:$("html").hasClass("dark")?getColor("slate.500",.3):getColor("slate.300"),borderDash:[2,2],drawBorder:!1}}}}})}})();