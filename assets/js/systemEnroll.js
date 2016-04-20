var selectEmployeesOut = document.getElementById('employees_to_add');
var selectEmployeesIn = document.getElementById('employees_added');
var btnAddEmployee = document.getElementById('addEmployee');
var btnDeleteEmployee = document.getElementById('deleteEmployee');
var btnSend = document.getElementById('btn_edit_course');

btnAddEmployee.addEventListener("click",function(){
	employeesSelected = getEmployeesSelected(selectEmployeesOut);
	deleteEmployees(employeesSelected, selectEmployeesOut);
	addEmployees(employeesSelected, selectEmployeesIn);
});

btnDeleteEmployee.addEventListener("click",function(){
	employeesSelected = getEmployeesSelected(selectEmployeesIn);
	deleteEmployees(employeesSelected, selectEmployeesIn);
	addEmployees(employeesSelected, selectEmployeesOut);
});

btnSend.addEventListener("click", function(){
	selectAllOptions(selectEmployeesIn);
});

function getEmployeesSelected(select){
	var opts = [], opt;
	for(var i = 0; i < select.options.length; i++){
		opt = select.options[i];
		if(opt.selected){
			opts.push(opt);
		}
	}
	return opts;
}

function deleteEmployees(employees, select){
	for(var i = 0; i < employees.length; i++){
		employeeToDelete = employees[i];
		for(var j = 0; j < select.options.length; j++){
			if(select.options[j].value == employeeToDelete.value){
				select.remove(j);
				break;
			}
		}
	}
}

function addEmployees(employees, select){
	for(var i = 0; i < employees.length; i++){
		employeeToAdd = employees[i];
		select.add(employeeToAdd);
	}
}

function selectAllOptions(select){
	for(var i = 0; i < select.options.length; i++){
		select.options[i].selected = true;
	}
}