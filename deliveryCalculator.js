ymaps.ready(init);

let Volvo = {
    name: "Volvo",
    size: 25,
    maxWeight: 1000,
    maxRange: 500000,
    deliveryCost: 20
}
let Subaru = {
    name: "Subaru",
    size: 10,
    maxWeight: 800,
    maxRange: 300000,
    deliveryCost: 5
}
let Fiat = {
    name: "Fiat",
    size: 30,
    maxWeight: 1500,
    maxRange: 600000,
    deliveryCost: 25
}
let Renault = {
    name: "Renault",
    size: 15,
    maxWeight: 1200,
    maxRange: 400000,
    deliveryCost: 10
}
let Nissan = {
    name: "Nissan",
    size: 20,
    maxWeight: 1350,
    maxRange: 450000,
    deliveryCost: 15
}
let Ford = {
    name: "Ford",
    size: 35,
    maxWeight: 2000,
    maxRange: 75000,
    deliveryCost: 30
}

var DELIVERY_TARIFF = 0
var DELIVERY_CAR = ""

let carsArr = [Ford, Fiat, Volvo, Nissan, Renault, Subaru]
    function deliveryTariff () {
        var deliveryLength = document.getElementById("deliveryLength").value
        var deliveryWidth = document.getElementById("deliveryWidth").value
        var deliveryHeight = document.getElementById("deliveryHeight").value
        var deliverySize = deliveryLength * deliveryWidth * deliveryHeight;
        var deliveryWeight = document.getElementById("deliveryWeight").value;
        if(deliverySize > 35 || deliveryWeight > 2000) {
            alert("Мы принимаем заказы только до 35 кубических метров объёма и 2 тонн");
            return;
        }
        var i = 0;
        while (i < carsArr.length) {
            if (carsArr[i].size >= deliverySize && carsArr[i].maxWeight >= deliveryWeight) {
                tempDeliveryCost = carsArr[i].deliveryCost
                tempCar = carsArr[i].name
            }
            i++
        }
        DELIVERY_TARIFF = tempDeliveryCost
        DELIVERY_CAR = tempCar
    }

function init() {
    // Минимальная стоимость.
        MINIMUM_COST = 500,
        myMap = new ymaps.Map('map', {
            center: [60.906882, 30.067233],
            zoom: 9,
            controls: []
        }),
    // Создадим панель маршрутизации.
        routePanelControl = new ymaps.control.RoutePanel({
            options: {
                // Добавим заголовок панели.
                showHeader: true,
                title: 'Расчёт доставки'
            }
        }),
        zoomControl = new ymaps.control.ZoomControl({
            options: {
                size: 'small',
                float: 'none',
                position: {
                    bottom: 145,
                    right: 10
                }
            }
        });
    // Пользователь сможет построить только автомобильный маршрут.
    routePanelControl.routePanel.options.set({
        types: {auto: true}
    });

    // Если вы хотите задать неизменяемую точку "откуда", раскомментируйте код ниже.
    /*routePanelControl.routePanel.state.set({
        fromEnabled: false,
        from: 'Москва, Льва Толстого 16'
     });*/

    myMap.controls.add(routePanelControl).add(zoomControl);

    // Получим ссылку на маршрут.
    routePanelControl.routePanel.getRouteAsync().then(function (route) {

        // Зададим максимально допустимое число маршрутов, возвращаемых мультимаршрутизатором.
        route.model.setParams({results: 1}, true);

        // Повесим обработчик на событие построения маршрута.
        route.model.events.add('requestsuccess', function () {

            var activeRoute = route.getActiveRoute();
            if (activeRoute) {
                // Получим протяженность маршрута.
                var length = route.getActiveRoute().properties.get("distance"),
                // Вычислим стоимость доставки.
                    price = calculate(Math.round(length.value / 1000)),
                // Создадим макет содержимого балуна маршрута.
                    balloonContentLayout = ymaps.templateLayoutFactory.createClass(
                        '<span>Расстояние: ' + length.text + '.</span><br/>' +
                        '<span>Автомобиль: ' + DELIVERY_CAR + '.</span><br/>' +
                        '<span style="font-weight: bold; font-style: italic">Стоимость доставки: ' + price + ' р.</span>');
                
                
                // Зададим этот макет для содержимого балуна.
                route.options.set('routeBalloonContentLayout', balloonContentLayout);
                // Откроем балун.
                activeRoute.balloon.open();
                //var waypoint = route.getWayPoints();

                //var object1 = myMap.referencePoints[0];
                var object1 = routePanelControl.routePanel.state.get("from");
                var object2 = routePanelControl.routePanel.state.get("to");


                //var object2 = route.getWayPoints(); 
                //var object2 = myMap.referencePoints[1];      
                const valueCase = {
                    punkt1: object1,
                    punkt2: object2,
                    dlina: length.text,
                    car: DELIVERY_CAR,
                    zena: price
                    };        
                localStorage.setItem('case', JSON.stringify(valueCase));
                localStorage.setItem('status', "Не подтвержён");
            }

            
        });

    });
    // Функция, вычисляющая стоимость доставки.
    function calculate(routeLength) {
        return Math.max(routeLength * DELIVERY_TARIFF, MINIMUM_COST);
    }
}