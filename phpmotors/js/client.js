'use strict'

// Get client info by clientId
let clientInfo = document.getElementsByName("clientId");

 let clientId = clientInfo.value;
 console.log(`clientId is: ${clientId}`);
 let classIdURL = "/phpmotors/accounts/index.php?action=getClientId&clientId=" + clientId;
 fetch(classIdURL)
 .then(function (response) {
  if (response.ok) {
   return response.json();
  }
  throw Error("Network response was not OK");
 })
 .then(function (data) {
  console.log(data);
 })
 .catch(function (error) {
  console.log('There was a problem: ', error.message)
 })