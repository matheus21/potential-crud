import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';

import Register from './pages/Register';
import List from './pages/List';
import Update from './pages/Update'

export default function Routes() {
    return (
    <BrowserRouter>
        <Switch>
            <Route path="/" exact component={List}/>
            <Route path="/register" component={Register}/>
            <Route path="/update/:id" component={Update}/>
            
        </Switch>
    </BrowserRouter>
    )
}