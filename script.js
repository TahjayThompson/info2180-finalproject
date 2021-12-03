window.addEventListener('load',(event)=>{

    const CLOSED = $(".closed");
    const PROGRESS = $(".progress");
    
    console.log(CLOSED);
    console.log(PROGRESS);
    
    
    CLOSED.on('click', e=>{
        let id = e.target.id;
    
        let update = {closed: id};

        $.ajax({
            type: "POST",
            url: "status_service.php",
            data: update,
            dataType: "html"
        }).done(res =>{
            let dateTime = res.split("+");

            udate = dateTime[0].slice(-23);
            udate = udate.trim();

            let date = $("#date");
            let time = $("#time");

            date.empty();
            date.append(udate);

            time.empty();
            time.append(dateTime[1]);
            
        }).fail(()=>{
            alert("failed to update status");
        });
    
    });
    
    
    PROGRESS.on('click', e=>{
        let id = e.target.id;
    
        let update = {progress: id};
    
        $.ajax({
            type: "POST",
            url: "status_service.php",
            data: update,
            dataType: "html"
        }).done(res =>{
            let dateTime = res.split("+");

            udate = dateTime[0].slice(-23);
            udate = udate.trim();

            let date = $("#date");
            let time = $("#time");

            date.empty();
            date.append(udate);

            time.empty();
            time.append(dateTime[1]);

        }).fail(()=>{
            alert("failed to update status");
        });
    
    });



});

