const bouton_resa_voyages = document.querySelectorAll(".bouton_resa");

for (let index = 0; index < bouton_resa_voyages.length; index++) {
    const element = bouton_resa_voyages[index];
    // console.log(element.id);

    const resa_voyage = document.querySelectorAll("."+element.id);
    for (let index = 0; index < resa_voyage.length; index++) {
        const element = resa_voyage[index];
        element.style.display = "none";
        bouton_resa_voyages.textContent = "Show Resa";
    }
    
    element.addEventListener('click',switch_resa_show(element.id,element))
}

function switch_resa_show(class_voyage,elem){
    const bouton = elem;
    // console.log(this);
    const resa_voyage = document.querySelectorAll("."+class_voyage);
    let value_display_init
    if (resa_voyage.length>0) {
        value_display_init = resa_voyage[0].style.display;
    }
    // console.log("/"+value_display_init+"/");
    let cmpt = 1;
    return ()=>{
        if (resa_voyage.length>0) {
            if (cmpt===0){
                cache_resa();
                cmpt=1;
            } else {
                show_resa();
                cmpt=0;
            }
        }
        console.log(cmpt);
    }
        
    function cache_resa(){
        for (let index = 0; index < resa_voyage.length; index++) {
            const element = resa_voyage[index];
            element.style.display = "none";
            bouton.textContent = "Show Resa";
        }
    }
    
    function show_resa(){ 
        for (let index = 0; index < resa_voyage.length; index++) {
            const element = resa_voyage[index];
            element.style.display = "";
            bouton.textContent = "Hide Resa";
        }
    }


}