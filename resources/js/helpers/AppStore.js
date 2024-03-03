class AppStorage{

    storeToken(token){
        window.localStorage.setItem('token', token);
    }

    storeUser(user){
        window.localStorage.setItem('user', user);
    }

    store(token, user){
        this.storeToken(token);
        this.storeUser(user);
    }

    clear(){
        window.localStorage.removeItem('token');
        window.localStorage.removeItem('user');
    }

    getToken(){
        window.localStorage.getItem('token');
    }

    getUser(){
        window.localStorage.getItem('user');
    }
}

export default AppStorage = new AppStorage();
