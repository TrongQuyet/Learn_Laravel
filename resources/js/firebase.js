import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
    apiKey: "AIzaSyAHB24sBfev0lolMSKD_nwRjrJA6oDGSV4",
    authDomain: "test-9ae10.firebaseapp.com",
    projectId: "test-9ae10",
    storageBucket: "test-9ae10.appspot.com",
    messagingSenderId: "16277668285",
    appId: "1:16277668285:web:fabf7593855da0f44252d4",
    measurementId: "G-1NLECMGYKE",
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);
getToken(messaging, {
    vapidKey:
        "BAjQgZkG5UBvp4IkuTtuZGU1uydud0l8MzoaHKcCQ5EsVH1r01bDYQCgW0ndwwruxINpmhs6Q5mDBJs8QGDppwk",
})
    .then((currentToken) => {
        if (currentToken) {
            console.log(currentToken);
        } else {
            console.log(
                "No registration token available. Request permission to generate one."
            );
        }
    })
    .catch((err) => {
        console.log("An error occurred while retrieving token. ", err);
    });

onMessage(messaging, (payload) => {
    console.log("Message received. ", payload);
    // ...
});
