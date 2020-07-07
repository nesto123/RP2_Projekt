
<?php

class RestaurantsController extends BaseController{

    public function index(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = $_SESSION['tab'] = 'Restaurants index';
        $this->registry->template->FoodList = $ls->getFoodListByRestaurantId( $_SESSION['restaurants']->id_restaurant );
        $this->registry->template->restaurantRating = $ls->getRestaurantRatingById( $_SESSION['restaurants']->id_restaurant );
        $this->registry->template->restaurantInfo = $ls->getRestaurantById( $_SESSION['restaurants']->id_restaurant );

        $this->registry->template->show( 'restaurants_index' );
    }

    public function pastOrders(){
        $ls = new Service();
        error404();
        debug();

        $this->registry->template->title = 'Prošle narudžbe';
        $_SESSION['tab'] = 'Prošle narudžbe';
        
        ////////////////////////////////
        $narudzbe = $ls->getOrderListByRestaurantId2( $_SESSION['restaurants']->id_restaurant );
        $pomocni = [];
        foreach ( $narudzbe as $narudzba ){
            $narudzba->id_restaurant = ( $ls->getRestaurantById ( $narudzba->id_restaurant ) )->name;
            $hrana = $ls->getFoodIdListByOrderId( $narudzba->id_order );
            $spiza = [];
            for ( $i=0; $i < count( $hrana ); $i++ ){
                $spiza[] = $ls->getFoodById( $hrana[$i][0] );
            }
            $pomocni[] = [$narudzba, $spiza];
        }
        $this->registry->template->orderList = $pomocni;
        $this->registry->template->show( 'restaurants_pastOrders' );
    }
    
    

};


//  -----------------
function error404(){        //  provjerava ako se korisnik odlogirao pa ga preusmjerava na 404
    if( !isset($_SESSION['restaurants']) ){
        header( 'Location: ' . __SITE_URL . '/index.php?rt=404' );
    }
}

function debug()
{
	echo '<pre>$_POST=';
	print_r( $_POST );
	if (session_status() !== PHP_SESSION_NONE) {
		
	echo '$_SESSION=';
	print_r( $_SESSION );
    }
	echo '</pre>';
}





?>