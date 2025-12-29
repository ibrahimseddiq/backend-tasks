<?php

$json_file = "tasks.json";
if (!file_exists($json_file)) {
    file_put_contents($json_file, json_encode([]));
}

echo"\n== To-Do List Program ==\n\n";

$json_content = file_get_contents($json_file);
$tasks = json_decode($json_content, true); // tasks is an array 

$counter = count($tasks);

while(true) 
{
    echo"---------------------\n";
    echo "1. Add a Task\n";
    echo "2. Putting a Status \n";
    echo "3. List All Tasks\n";
    echo "4. Delete a Task\n";
    echo "5. Exit\n";
    echo "Enter a Choise: ";
    $number = trim(fgets(STDIN));
    echo"\n---------------------\n\n";
    if($number === "1") //Adding new task
    {
        
        $json_content = file_get_contents($json_file);
        $tasks = json_decode($json_content, associative: true); // tasks is an array 
        $counter++;
        echo "Task Name: ";
        $task_name = trim(fgets(STDIN));
        $new_task = ["Task Number"=>$counter ,"name" => $task_name, "Status" => false];
        $tasks[] = $new_task;
        file_put_contents($json_file, json_encode($tasks));
        echo "Task added Successfuly!\n";
    }

        elseif($number === "2") // Status
    {
        $json_content = file_get_contents($json_file);
        $tasks = json_decode($json_content, associative: true); // tasks is an array 
        $json_content = file_get_contents($json_file); $tasks = json_decode($json_content, associative: true); // tasks is an array 
        echo " Task Number for Make it Done: "; 
        $task_number = trim(fgets(STDIN));
        $found = false;
        foreach($tasks as &$task) 
        {
            if($task["Task Number"] == $task_number) 
            {
                $task["Status"] = true;
                $found = true;
                break;
            }
        }
        if($found) 
        {
            file_put_contents($json_file, json_encode($tasks));
            echo "Task is Done!\n";
        } 
        else 
        {
            echo "Invalid Task Number!\n";
        }
    }


    elseif($number === "3") 
    {
        // Code of Printig the list 
        $json_content = file_get_contents($json_file); 
        $tasks = json_decode($json_content, associative: true); // tasks is an array 
        foreach ($tasks as $task) 
        { 
            $state = ""; 
            if($task["Status"] != true) 
                $state = "Not Done"; 
            else
                $state = "Done"; 
            echo "Task({$task['Task Number']}): {$task['name']} => is $state!\n"; 
        } 
    }
    elseif($number === "4")
    {
        
        $json_content = file_get_contents($json_file);
        $tasks = json_decode($json_content, associative: true); // tasks is an array 
        echo "Task's Number To Delete: ";
        $task_number = trim(fgets(STDIN));
        $found = false;
        Delete_Task($task_number, $tasks,$found);
        if($found)
        {
            $counter--;
            foreach($tasks as $i => &$task)
            {
                $task["Task Number"] = $i+1;            
            }
            
            file_put_contents($json_file, json_encode($tasks, JSON_PRETTY_PRINT));
        }
        //file_put_contents($json_file, json_encode($tasks, JSON_PRETTY_PRINT));
    }

    elseif($number === "5")
    {
        echo "Ok! See You Later!\n";
        break;
    }

    else
    {
        echo "Invalide Choise!\n";
    }
}
function Delete_Task($task_id,array &$Tasks,bool &$found) 
{
    $found = false;
    foreach($Tasks as $task)
    {
        if($task["Task Number"] == $task_id)
        {
            $found = true;
            break;
        }
    }
    if(!$found)
        echo"Invalid ID!";
    else
    {
        $Tasks = array_filter($Tasks,fn($value) => $value["Task Number"] != $task_id);
        $Tasks = array_values($Tasks); // To Reset the Keys
        echo"The Task Deleted Successfully!\n";
    }
}

?>