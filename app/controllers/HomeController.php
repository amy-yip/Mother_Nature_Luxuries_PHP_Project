<?php

class HomeController extends Controller
{

	public function index()
	{
		
		if($_SESSION['user_id'] == null)
	    {
		   header('location:/login/index');
	       return;
	    }

		$items = $this->model('item')->get();
		$this->view('home/index', ['items'=>$items]);
	}

	public function create()
	{
		
		if($_SESSION['user_id'] == null)
	    {
		   header('location:/login/index');
	       return;
	    }
	    

		if(isset($_POST['action']))
		{
           $newItem = $this->model('Item');
           $newItem->name = $_POST['name'];
           $newItem->create();
           header('location:/home/index');
		}

		else
		{
			$this->view('home/create');
		}
	}

	public function detail($item_id)
	{
		
		if($_SESSION['user_id'] == null)
	    {
		  header('location:/login/index');
	      return;
	    }

		$theItem = $this->model('Item')->find($item_id);
		$this->view('home/detail', $theItem);
	}

	public function edit($item_id)
	{

		if($_SESSION['user_id'] == null)
	    {
		   header('location:/login/index');
	       return;
	    }

		$theItem = $this->model('Item')->find($item_id);

		if(isset($_POST['action']))
		{
           $theItem->name = $_POST['name'];
           $theItem->update();
           header('location:/home/index');
		}

		else
		{
			$this->view('home/edit', $theItem);
		}
	}


	public function delete($item_id)
	{

		if($_SESSION['user_id'] == null)
	    {
		   header('location:/login/index');
	       return;
	    }
	    
		$theItem = $this->model('Item')->find($item_id);

		if(isset($_POST['action']))
		{
           $theItem->delete();
           header('location:/home/index');
		}

		else
		{
			$this->view('home/delete', $theItem);
		}
	}
}

?>