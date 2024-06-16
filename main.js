document.querySelector('.col').addEventListener('click', e => {
    let region = e.target.innerText;
    $data = database(region);
    console.log($data);
});


