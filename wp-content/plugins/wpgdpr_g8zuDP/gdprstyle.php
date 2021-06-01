
<?php
function gdprstyle() 
{
$style=
'
<style>

.containerr {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}


.containerr input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}


.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}


.containerr:hover input ~ .checkmark {
  background-color: #ccc;
}


.containerr input:checked ~ .checkmark {
  background-color: #2196F3;
}


.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}


.containerr input:checked ~ .checkmark:after {
  display: block;
}


.containerr .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
input[type=submit].gdpracceptbutton
{
	background-color:#337ab7;
	cursor: pointer;
display: inline-block;
font-size: 14px;
font-size: 0.875rem;
font-weight: 800;
line-height: 1;
padding: 1em 2em;
text-shadow: none;
-webkit-transition: background 0.2s;
transition: background 0.2s;
	
}
</style>     

';
return $style;
}

?>