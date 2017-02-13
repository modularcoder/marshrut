<div class="sidebar">
    <div class="sidebarContainer">

        <div class="scrollPane">
            <!-- Start Search by street -->
            <div class="title">
              Որոնում ըստ փողոցների
            </div>

            <!-- <blockquote>
              <p>Որոնում ըստ փողոցների</p>
            </blockquote> -->

            <form  style="padding-left:20px;" class="" id="searchForm" action="<?= htmURL ?>" >
                <div class="form-group">
                    <label>Սկզբնակետ</label>
                    <input type="text" class="form-control" 
                        name="searchFrom" id="searchFrom" 
                        value="<?= $searchFrom ?>"
                        placeholder="Օրինակ` Քոչար">
                </div>
                <div class="form-group">
                    <label>Վերջնակետ</label>
                    <input type="text" class="form-control" 
                        name="searchTo" id="searchTo" 
                        value="<?= $searchTo ?>"
                        placeholder="Օր.` Բաղրամյան">
                </div>

                <div class="form-group tr">
                    <button type="submit" id="searchSubmit" 
                        class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span>
                        Որոնել
                    </button>

                </div>
            </form>
            <!-- End Search by street -->

            <!-- Start Search by number -->
            <!-- <blockquote>
              <p>Որոնում ըստ համարների</p>
            </blockquote> -->
            <div class="title" style="margin-top:25px;">
              Որոնում ըստ համարների
            </div>

            <div style="padding-left:20px;">
              
                <form id="routesSearchByNumbersForm">
                    <div class="form-group">
                        <select  class="chosen-select form-control"   
                            id="routeNumberSelect" style="width:100%"
                            data-placeholder="Ընտրեք համարը">

                            <option value=""></option>

                            <?php foreach($routeTypes as $type=>$typeTitle): ?>
                              <?php $numRoutes = getRoutesByType($type); ?>

							  <?php $typeTitle = mb_convert_case($typeTitle, MB_CASE_TITLE, "UTF-8"); ?>
                              <optgroup label="<?= $typeTitle ?>">
                              
                                <?php foreach($numRoutes as $route): ?>
                                  <option value="<?= $route['route_id'] ?>">
                                    <?= $route['route_number']; ?>

                                    <?php
                                      if(!empty($route['notes'])) {
                                        echo '('.$route['notes'].')';
                                      }
                                    ?>

                                  </option>
                                <?php endforeach; ?>

                              </optgroup>


                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <!-- End Search by number -->
        </div>
        <div class="scrollPaneFooter">
            
        </div>

    </div>
</div>