FOR SUGGESTIONS, IDEAS AND COLLABORATIONS FEEL FREE TO CONTACT ME:

WORKING CONTACTS:
-email: emanuele.g.tino@gmail.com
-phone (SE): +46-701892053
-phone (ITA): +39-3713845202
-linkedin: https://www.linkedin.com/in/emanuele-tino/

This is a mock up version i've made of a beautifully tailored car congifurator.
The stack is Laravel-Vue in a monolitic structure (inertia).
The application is a non-indexed microservice, therefore i opted to have it CSR.
The library i have used for the maps is an open source library called LeaFlet. Ziggy to ensure dynamic routing related to the route names, and mPDF for the creating of pdf instances.
For the mailing system i used the built in Facades Mail class.

Countries, cities and addresses are different migrations with a relation one to many, and each address contains the latitude and longitude values which are used to dinamically render the markups on the map and the map view.

For personal practice, in order to have a two way model binding i choose to use both the older syntax with emits and props and the newer introduced in vue 3.4 with defineModel() so in the code you'll eventually find both.
