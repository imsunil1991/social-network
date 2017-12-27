
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
   msg: 'Update New Post:',
   content: '',
   posts: [],
   postId: '',
   successMsg: '',
   commentData:{},
   commentSeen: false,
   image:''
  },

 ready: function(){
   this.created();
 },

 created(){
   axios.get('http://localhost/Social-Network/index.php/posts')
        .then(response => {
          console.log(response); // show if success
          this.posts = response.data; //we are putting data into our posts array
          Vue.filter('myOwnTime', function(value){
            return moment(value).fromNow();
          });
        })
        .catch(function (error) {
          console.log(error); // run if we have error
        });    
 },

 methods:{
   addPost(){
     axios.post('http://localhost/Social-Network/index.php/addPost', {
            content: this.content
          })
          .then(function (response) {
            console.log('saved successfully'); // show if success
            if(response.status===200){
              app.posts = response.data;
            }
          })
          .catch(function (error) {
            console.log(error); // run if we have error
          });
   },

   deletePost(id){
     axios.get('http://localhost/Social-Network/index.php/deletePost/' + id)
          .then(response => {
            console.log(response); // show if success
            this.posts = response.data; //we are putting data into our posts array
          })
          .catch(function (error) {
            console.log(error); // run if we have error
          });
   },
   likePost(id){
     axios.get('http://localhost/Social-Network/index.php/likePost/' + id)
          .then(response => {
            console.log(response); // show if success
            this.posts = response.data; //we are putting data into our posts array
          })
          .catch(function (error) {
            console.log(error); // run if we have error
          });
   },    
   addComment(post,key){
   
	       axios.post('http://localhost/Social-Network/index.php/addComment', {
            comment: this.commentData[key],
			      id: post.id
          })
          .then(function (response) {
            console.log('saved successfully'); // show if success
            if(response.status===200){
              app.posts = response.data;
            }
          })
          .catch(function (error) {
            console.log(error); // run if we have error
          });
	   
   },

   onFileChange(e){
     var files = e.target.files || e.dataTransfer.files;
     this.createImg(files[0]); // files the image/ file value to our function

   },
   createImg(file){
    // we will preview our image before upload
    var image = new Image;
    var reader = new FileReader;

    reader.onload = (e) =>{
          this.image = e.target.result;
    };
    reader.readAsDataURL(file);
   },

   uploadImg(){
    axios.post('http://localhost/Social-Network/index.php/saveImg', {
      image: this.image
    })
    .then(function (response) {
      console.log(response.data); // show if success
     
    })
    .catch(function (error) {
      console.log(error); // run if we have error
    });
   },
   removeImg(){
     this.image=""
   }
   

 
 }
});
