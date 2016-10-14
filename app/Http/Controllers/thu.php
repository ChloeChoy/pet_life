<?php 
class  customer{
	
	$name;
	$address;
	$affiliate;
	function __construct($vname, $vaddress,affiliate $vaffiliate){

		$this->name=$vname;
		$this->address=$vaddress;
		$this->affiliate=$vaffiliate;
	}
	public placeOrder($money,StoreOwner $storeower){
		$new_order= new order($money);
		$mount=($new_order->total)/10;
		$this->affiliate->balance=$mount;
		$storeower->balance=$mount*9;
		$this->affiliate->subAffiliates->balance=$mount/2;
	}
	public set_affiliate(affiliate $vaffiliate){
		$this->affiliate=$vaffiliate;
	}
}
class order{
	$total;
	function __construct($valuetotal){
		$this->total=$valuetotal;
	}

}
class affiliate{
	$name;
	$balance;
	$upperAffiliate;
	$subAffiliates=array();
	$customer=array();
	function __construct($vname){
		$this->name=$vname;
		$this->balance=0;
		$this->upperAffiliate=null;
		$this->subAffiliates=null;
		$this->customer=null;

	}
	function __construct($vname, affiliate $upper ){
		$this->name=$vname;
		$this->balance=0;
		$this->upperAffiliate=$upper;
		$this->subAffiliates=null;
		$this->customer=null;

	}
	public refer(customer $newcustomer,affiliate $newaffiliate){
			 array_push($this->customer, $newcustomer);
			 $newcustomer->set_affiliate($this);
			 array_push($this->subAffiliates, $newaffiliate);
			 $newaffiliate->set_upperAffiliate($this);
	}
	public Withdraw( $money){
		if($this->balance>=100 && $money<=$this->balance){
			$this->balance-=$money;
		}
		echo "money is: ".$this->balance;
	}
	public PrintSubAff(){
		foreach($this->subAffiliates as $value){
 			 echo $value->name;
 			 echo $value->balane;
		}
	}
	public PrintCustomers(){
		foreach($this->customer as $value){
 			 echo $value->name;
		}
	}
	public set_upperAffiliate(affiliate $newaffiliate){
		$this->upperAffiliate=$newaffiliate;
	}

}

class StoreOwner{
	$name;
	$balance;
	function __construct($vname){
		$this->name=$vname;
		$this->balance=0;
	}
	public Print_balance(){
		echo $this->balance;
	}
}

$new_store = new StoreOwne("Moyes");
$john= new affiliate("John");

$sarah= new affiliate("Sarah");
$eva= new affiliate("Eva");
$jimmy= new affiliate("Jimmy");
$henry= new affiliate("Henry");
$arr=array($sarah,$eva,$jimmy,$henry);
$money=$800;
for($i=0;$i<8;$i++){
	$customer[$i]= new customer("i");
	$customer[$i]->placeOrder($money,$new_store);
}
$i=0;
foreach($arr as $value){
 	$john->refer(null, $value);
 	$value->refer($customer[$i], null);
}

$john->PrintSubAff();
$john->Withdraw($300);
$john->Withdraw($150);
$john->Withdraw($50);
$new_store->Print_balance();
?>