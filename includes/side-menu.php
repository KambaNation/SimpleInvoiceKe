<div class="sidebar collapse">
    <div class="sidebar-content">
      <!-- User dropdown -->
      <div class="user-menu dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $profile_image  ?>" alt="Userimage">
        <div class="user-info"><?php echo $profile_username ?> <span><?php echo $_SESSION['user'] ?></span></div>
        </a>
        
      </div>
      <!-- /user dropdown -->
      <!-- Main navigation -->
      <ul class="navigation">
        <li <?php if ($page=="dashboard"){ ?>class="active"<?php }?>><a href="dashboard.php"><span>Dashboard</span> <i class="icon-screen2"></i></a></li>
        <li <?php if ($mainpage=="catalog"){ ?>class="active"<?php }?>><a href="#" class="expand"><span>Catalog</span> <i class="fa fa-clipboard" aria-hidden="true"></i></a>
		<ul>
            <li <?php if ($page=="add-products"){ ?>class="active"<?php }?> ><a data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal">Create Product</a></li>
            <li <?php if ($page=="products"){ ?>class="active"<?php }?> id="navProduct"><a href="products.php">View Products</a></li>
            <li <?php if ($page=="products"){ ?>class="active"<?php }?>><a href="brands.php">View Brands</a></li>
            <li <?php if ($page=="products"){ ?>class="active"<?php }?>><a href="category.php">Category</a></li>
          </ul>
		</li>
        <li  <?php if ($mainpage=="quotes"){ ?>class="active"<?php }?>><a href="#" class="expand" ><span>Quotes</span> <i class="fa fa-book" aria-hidden="true"></i></a>
		<ul>
            <li <?php if ($page=="add-quote"){ ?>class="active"<?php }?>><a href="create-quote.php">Create Quote</a></li>
            <li <?php if ($page=="qoutes"){ ?>class="active"<?php }?>><a href="quotes.php">View Quote</a></li>
          </ul>
		</li>
        <li <?php if ($mainpage=="customers"){ ?>class="active"<?php }?>><a href="#" class="expand" ><span>Customers</span> <i class="fa fa-address-book-o" aria-hidden="true"></i></a>
		<ul>
            <li <?php if ($page=="add-customer"){ ?>class="active"<?php }?>><a href="create-customer.php">Add Customer</a></li>
            <li <?php if ($page=="customers"){ ?>class="active"<?php }?>><a href="customers.php">View Customers</a></li>
          </ul>
		</li>
          <?php if($_SESSION['user']=="admin") { ?>
              <li <?php if ($mainpage == "invoices"){ ?>class="active"<?php } ?>><a href="#" class="expand"><span>Invoices</span>
                      <i class="fa fa-area-chart" aria-hidden="true"></i></a>
                  <ul>
                      <li <?php if ($page == "add-invoice"){ ?>class="active"<?php } ?>><a href="create-invoice.php">Create
                              Invoice</a></li>
                      <li <?php if ($page == "invoices"){ ?>class="active"<?php } ?>><a href="invoices.php">View
                              Invoices</a></li>
                  </ul>
              </li>
              <?php
          }
          ?>

            <?php if($_SESSION['user']=="admin") { ?>

          <li <?php if ($mainpage == "reports"){ ?>class="active"<?php } ?>><a href="#"
                                                                               class="expand"><span>Reports</span> <i
                          class="fa fa-bar-chart" aria-hidden="true"></i></a>
              <ul>

                  <li <?php if ($page == "quote-report"){ ?>class="active"<?php } ?>><a href="quote-report.php">Quote
                          Reports</a></li>
                  <li <?php if ($page == "invoice-report"){ ?>class="active"<?php } ?>><a href="invoice-report.php">Invoice
                          Reports</a></li>
                  <li <?php if ($page == "customer-report"){ ?>class="active"<?php } ?>><a href="customer-report.php">Customer
                          Reports</a></li>
                 <!-- <li <?php if ($page == "project-report"){ ?>class="active"<?php } ?>><a href="project-report">Project
                          Reports</a></li>-->
              </ul>
          </li>
      <?php
      }
          ?>
          <?php if($_SESSION['user']=="admin") { ?>
              <li <?php if ($mainpage == "users"){ ?>class="active"<?php } ?>><a href="#"
                                                                                 class="expand"><span>Users</span> <i
                              class="fa fa-users"></i></a>
                  <ul>

                      <li <?php if ($page == "add-user"){ ?>class="active"<?php } ?>><a href="create-user.php">Add User</a>
                      </li>
                      <li <?php if ($page == "users"){ ?>class="active"<?php } ?>><a href="users.php">View Users</a></li>
                  </ul>
              </li>
              <?php
          }
          ?>
          <?php if($_SESSION['user']=="admin") { ?>
              <li <?php if ($page == "settings"){ ?>class="active"<?php } ?>><a href="settings.php"><span>Settings</span> <i
                              class="fa fa-cogs" aria-hidden="true"></i></a></li>
              <?php
          }
          ?>
        
      </ul>
      <!-- /main navigation -->
    </div>
  </div>