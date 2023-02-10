   
 
   <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="<?=ASSETS?>admin/images/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?=ucwords($data['name'])?></h5>
              	  <h5 class="centered" style="font-size:14px;"><?=$data['email']?></h5>	

 
                  <li class="sub-menu">
                      <a href="javascript:;" >
                      <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/books" >
                      <i class="fa fa-barcode fa-fw"></i>
                          <span>Books</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/categories" >
                      <i class="fa fa-barcode fa-fw"></i>
                          <span>Categories</span>
                      </a>
                      <!-- <ul class="sub">
                          <li><a  href="<?=ROOT?>admin/categories">View Categories</a></li>
                      </ul> -->
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/authors" >
                      <i class="fa fa-barcode fa-fw"></i>
                          <span>Authors</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="<?=ROOT?>admin/publishers" >
                      <i class="fa fa-barcode fa-fw"></i>
                          <span>Publisher</span>
                      </a>
                  </li


              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->


    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT  - middle content
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> <?= ucwords($data['Page_title'])?></h3>
          	<div class="row mt">
          		<div class="col-lg-12">
