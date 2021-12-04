document.addEventListener('DOMContentLoaded', function() {
    allBtn = document.getElementById("all");
    openBtn = document.getElementById("open");
    ticketBtn = document.getElementById("all-t");
    createBtn = document.getElementById("createIssue");

    // ************removes side navs**************
    /*$(".sideNav").empty();
    $(".sideNav").remove();*/
    
    //funtion to add focus to btns
    function add_focus(btn){
        btn.classList.add('selected');
    }
    
    ticketBtn.addEventListener('click', e=>{
        openBtn.classList.remove('selected');
        allBtn.classList.remove('selected');
        add_focus(ticketBtn);
    });

    openBtn.addEventListener('click', e=>{
        ticketBtn.classList.remove('selected');
        allBtn.classList.remove('selected');
        add_focus(openBtn);
    });

    allBtn.addEventListener('click', e=>{
        ticketBtn.classList.remove('selected');
        openBtn.classList.remove('selected');
        add_focus(allBtn);
    });


    allBtn.addEventListener('click',e=>{
        let submit_data ={issue_data: 'all'};

        $.ajax({
            type: "GET",
            url:"dashboard_service.php",
            data:submit_data,
            dataType: "html"
        }).done(response=>{
            console.log(response);
            $("#result").empty();
            $("#result").append(response);
            // console.log("response recv");
            set_btn_color();
            
        }).fail(()=>{
            $("#result").empty();
            $("#result").append("<h2> Failed to fetch data from the server.</h2>");
            
        });


    });



    openBtn.addEventListener('click',e=>{
        let submit_data ={issue_data: 'open'};

        $.ajax({
            type: "GET",
            url:"dashboard_service.php",
            data:submit_data,
            dataType: "html"
        }).done(response=>{
            console.log(response);
            $("#result").empty();
            //set_btn_color();
            $("#result").append(response);
            // console.log("response recv");
            set_btn_color();

        }).fail(()=>{
            $("#result").empty();
            $("#result").append("<h2> Failed to fetch data from the server.</h2>");
            
        });
    });

    ticketBtn.addEventListener('click',e=>{
        let submit_data ={issue_data: 'id'};

        $.ajax({
            type: "GET",
            url:"dashboard_service.php",
            data:submit_data,
            dataType: "html"
        }).done(response=>{
            console.log(response);
            $("#result").empty();
            $("#result").append(response);
            // console.log("response recv");
            set_btn_color();

        }).fail(()=>{
            $("#result").empty();
            $("#result").append("<h2> Failed to fetch data from the server.</h2>");
            
        });
    });
/**    var info = document.querySelector('row');
    console.log(info); */
});

function set_btn_color(){
  var result = document.getElementById('result');
  var elem =  result.childNodes[15].childNodes[3].childNodes[0].childNodes[5];
  var status = elem.innerHTML;
  //console.log("i am stat", result.childNodes[15].childNodes[3].childNodes[0]);
  if (status== 'Open'){
    //elem.classList.add('OPEN');
    elem.classList.add("OPEN");
    console.log(elem);
  } else if (status == "closed"){
    elem.classList.add("CLOSED");
  } else{
    elem.classList.add("progress");
  }

}
