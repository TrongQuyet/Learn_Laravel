 // Scripts for firebase and firebase messaging
 importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js");
 importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js");

 // Initialize the Firebase app in the service worker by passing the generated config
 const firebaseConfig = {
     apiKey: "AIzaSyAHB24sBfev0lolMSKD_nwRjrJA6oDGSV4",
     authDomain: "test-9ae10.firebaseapp.com",
     projectId: "test-9ae10",
     storageBucket: "test-9ae10.appspot.com",
     messagingSenderId: "16277668285",
     appId: "1:16277668285:web:fabf7593855da0f44252d4",
     measurementId: "G-1NLECMGYKE",
 };

 firebase.initializeApp(firebaseConfig);

 // Retrieve firebase messaging
 const messaging = firebase.messaging();

 messaging.onBackgroundMessage(function(payload) {
   console.log("Received background message ", payload);

   const notificationTitle = payload.notification.title;
   const notificationOptions = {
     body: payload.notification.body,
   };

   self.registration.showNotification(notificationTitle, notificationOptions);
 });
