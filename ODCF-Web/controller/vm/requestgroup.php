<?php
require dirname(__FILE__).'/../../model/connect.php';
require dirname(__FILE__).'/../../model/controller.php';
require dirname(__FILE__).'/../../model/database.php';

$vm_list = get_vm($_SESSION['usr']);

$next_groupid = get_next_vm_groupid();
$vmip_group_list = array();
$vmid_group_list = array();

foreach ($vm_list as $vm)
{
	if(isset($_POST[$vm['id']]))
	{
		// Add the vm_ip to the list
		array_push($vmip_group_list,$vm['INET_NTOA(`ipv4`)']);
		array_push($vmid_group_list,$vm['id']);
		// // get the group id of each vm
		// $group_id = get_vm_group($vm['id']);
		// if ($group_id!='None')
			
		// 	if (!isset($min_group))
		// 		$min_group = $group_id;
		// 	else
		// 		if ($min_group > $group_id)
		// 			$min_group = $group_id;
	}
}

// Request the controller to inter connect them
$result = request_intervm_communication($vmip_group_list);

if ($result == True)
{
	// Get next available group id
	$new_group_id = get_vm_groupid($vmid_group_list);
	//Add group to Database
	foreach ($vmid_group_list as $vm_id) {
		$group_id = get_vm_group($vm_id);
		if ($group_id=='None')
			insert_vm_group($vm_id, $new_group_id);
		else
			set_vm_group($vm_id, $new_group_id);
	}
?>
	<h1>Inter Virtual Machine Communication Successfully established</h1>
	<h2>The current inter virtual machine communication request was successfully completed. </h2>
	<h2>From now on the VMs belonging to the group <?php echo $new_group_id; ?> can communicate directly.
	 	<p> To view the list of groups <a href="vm_groups.php">Click Here</a></p>
	 
	<?php
}
else
{
	?>
	<h1>Inter Virtual Machine Communication Failed</h1>
	<h2>The current inter virtual machine communication request could not be satisfied. Please contact the administrator for more info.</h2>
	<?php
}

?>