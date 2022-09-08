var casef = JSON.parse(localStorage.getItem('case'));
var status = localStorage.getItem('status');

if(status)
{
    if(status == "Не подтвержён")
    {
        if(casef)
        {
            document.getElementById("case1").innerHTML= casef.punkt1;
            document.getElementById("case2").innerHTML= casef.punkt2;
            document.getElementById("case3").innerHTML= casef.dlina;
            document.getElementById("case4").innerHTML= casef.car;
            document.getElementById("case5").innerHTML= casef.zena;
            document.getElementById("case6").innerHTML= status;
        }
    }
    else
    {
        document.getElementById("cars").style.display = 'none';
        
    }


}

function alerted(){
    localStorage.setItem('status', "Подтвержён");
    alert("Вы подтвердили доставку у Виталий Витальевич");
}



