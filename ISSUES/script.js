document.addEventListener('DOMContentLoaded', function() {
    allBtn = document.getElementById("all");
    openBtn = document.getElementById("open");
    ticketBtn = document.getElementById("all-t");
    createBtn = document.getElementById("createIssue");


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

        }).fail(()=>{
            $("#result").empty();
            $("#result").append("<h2> Failed to fetch data from the server.</h2>");
            
        });
    });


    
})