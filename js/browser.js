// //
// //
// // $(function () {
// //     // 搜索选项二级联动
// //     const China = ['Shanghai', 'Kunming', 'Beijing', 'Yantai'];
// //     const Japan = ['Tokyo', 'Osaka', 'Kamakura'];
// //     const Italy = ['Roma', 'Milan', 'Venice', 'Florence'];
// //     const America = ['New York', 'San Francisco', 'Washington'];
// //
// //     $("#country").on("change", function () {
// //         if ($("#country").value() === "China") {
// //             add(China);
// //         } else if ($("#country").value() === "Japan") {
// //             add(Japan);
// //         } else if ($("#country").value() === "Italy") {
// //             add(Italy);
// //         } else if ($("#country").value() === "America") {
// //             add(America);
// //         }
// //         else if($("#country").value()==="0"){
// //             const city = $("#city");
// //             city.empty();
// //             city.append($("<option>Filter by Cites</option>"));
// //         }
// //     })
// // });
// //
// // function add(country) {
// //     const city = $("#city");
// //     city.empty();
// //     city.append($("<option>Filter by Cites</option>"));
// //     for (var i = 0; i <= country.length - 1; i++) {
// //         city.append($("<option>"+country[i]+"</option>"))
// //     }
// // }
// var shengfengarr=["陕西","四川","上海"]
// var cityarr=[
//     ["西安市","宝鸡市","渭南市","汉中市"],
//     ["成都市","攀枝花市","乐山市"],
//     ["黄浦区","静安区","浦东区"]
// ]
// //添加省份
// var shengfen=document.getElementById("proci");
// function creatoption(shengfen,data){
//     for (var i in shengfengarr){
//         var op=new Option(data[i],i);
//         shengfen.options.add(op);
//     }
// }
// creatoption(shengfen,shengfengarr);
// //添加市区
// var city=document.getElementById("city2");
// shengfen.onchange=function(){
//     city.options.length=0;//清空已有的下拉列表
//     creatoption(city,cityarr[shengfen.value]);
//
// }
$(function () {
    // 搜索选项二级联动
    var China = ['Shanghai', 'Kunming', 'Beijing', 'Yantai'];
    var Japan = ['Tokyo', 'Osaka', 'Kamakura'];
    var Italy = ['Roma', 'Milan', 'Venice', 'Florence'];
    var America = ['New York', 'San Francisco', 'Washington'];

    $("#country").on("change", function () {
        if ($("#country").val() === "China") {
            add(China);
        } else if ($("#country").val() === "Japan") {
            add(Japan);
        } else if ($("#country").val() === "Italy") {
            add(Italy);
        } else if ($("#country").val() === "America") {
            add(America);
        }
    })
});

function add(country) {
    var city=$("#city");
    city.empty();
    city.append($("<option>Filter by Cites</option>"));
    for (var i = 0; i <= country.length - 1; i++) {
        city.append($("<option>"+country[i]+"</option>"))
    }
}