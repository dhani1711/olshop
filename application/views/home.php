
<h3 >Selamat Datang <?=$this->session->userdata('nama_user')?></h3>

  <p class="panel-subtitle">Toko Souvenir SouShop</p>

          <div class="panel-body">
            <div class="row">
              <div class="col-md-4">
            <?php if($this->session->userdata('level')=='admin'){?>
              <a href="<?=base_url('index.php/Kasir')?>" style="color: black">
              <?php }?>
                <div class="metric">
                  <span class="icon"><i class="fa fa-eye"></i></span>
                  <p>
                    <span class="number"><?= $user?></span>
                    <span class="title">Pegawai</span>
                  </p>
                </div>
              <?php if($this->session->userdata('level')=='admin'){?>
              </a>
              <?php }?>
              </div>
              <div class="col-md-4">

              <a href="<?=base_url('index.php/Histori')?>" style="color: black">
                <div class="metric">
                  <span class="icon"><i class="fa fa-shopping-cart"></i></span>
                  <p>
                    <span class="number"><?= $transaksi ?></span>
                    <span class="title">penjualan</span>
                  </p>
                </div>

                </a>
              </div>
              <div class="col-md-4">
              <a href="<?=base_url('index.php/Barang')?>" style="color: black">
                <div class="metric">
                  <span class="icon"><i class="fa fa-bar-chart"></i></span>
                  <p>
                    <span class="number"><?= $barang ?></span>
                    <span class="title">barang</span>
                  </p>
                </div>

                </a>
              </div>
            </div>

          </div>

<div class="boss" style="width">




</div>
<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5>TOP PRODUCT</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-heart"></i> 122</p>
									</div>
									<div class="col-sm-6 col-xs-6"></div>
	                      		</div>
	                      		<div class="centered">
										<img src="<?=base_url('assets/img/snowball-rusa.jpg')?>" width="120">
	                      		</div>
                      		</div>
                      	</div><!-- /col-md-4 -->
