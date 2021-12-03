window.addEventListener('load',(event)=>{

    const CLOSED = $(".closed");
    const PROGRESS = $(".progress");
    
    console.log(CLOSED);
    console.log(PROGRESS);
    
    
    CLOSED.on('click', e=>{
        let id = e.target.id;
    
        let update = {closed: id};
        console.log(update);
        $.ajax({
            type: "POST",
            url: "status_service.php",
            data: update,
            dataType: "html"
        }).done(res =>{
            alert(`${res}`);
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
            alert(`${res}`);
        }).fail(()=>{
            alert("failed to update status");
        });
    
    });



});

