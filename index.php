

<body>
    <form class="form-weather" method="POST">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Enter City</label>
        <input type="text" class="form-control" name="City">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <?php 
        include('regions.php'); 
        if($_POST) {
        $City = $_POST['City'];
        $data = database($City);

        if (!count($data)) {
            echo "City not found";}
        else {
            $AvgTemp = 0;

            for($i = 0; $i < count($data); $i++){
                $AvgTemp+= $data[$i]['AvgTemperature'];
            };

            $celsius = 5/9*($AvgTemp/count($data)-32);

            ?>
            <div class="response">
            <?php 
            echo 'Die Durchschnittstemperatur in '.$City.' liegt bei: '.number_format($celsius,2).'° Celsius.';
            };?>
            </div>
            <?php
    }?>
            <div class="container">
                <div class="row">
                    <div class="col regions">

                        <?php 
                        
                        $data = database('all');
                        $Regions = array();
                        for($i = 0; $i < count($data); $i++){
                            $key = $data[$i]['Region'];
                            $Regions[] = $key;
                        };
                
                        $uniqueRegions = array_unique($Regions);
                        foreach($uniqueRegions as $Region){ ?>
                            <ul class="list-group">
                            <li class="list-group-item"><?php echo $Region?></li>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col citys">
                            <ul class="list-group citys">
                            </ul>
                    </div>

                </div>
            </div>

            <script>
                        document.querySelector('.col').addEventListener('click', e => {
                            let region = e.target.innerText;
                            console.log(region);
                            fetch("citysDB.php", {
                                'method': 'POST',
                                'headers': {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json; charset=utf-8'
                                },
                                'body': JSON.stringify(region),
                            }).then(e => e.json()).then(e => {
                                let citys = Object.values(e);
                                citys.forEach((e) => {
                                    let parent = document.querySelector('ul.citys');
                                    let listitem = document.createElement('ul');
                                    listitem.className = 'list-group';
                                    listitem.innerHTML = `<li class="list-group-item"> <a href="city/${e}">${e}</a></li>`;
                                    parent.appendChild(listitem);
                                })

                            })
                        });
            </script>

</body>
</html>

