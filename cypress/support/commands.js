// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

Cypress.Commands.add('register', (email = `email@email${new Date().getTime()}.com`, password = `Senha123${new Date().getTime()}`, name = 'Test User') => {
     cy.visit('/register');

        cy.get('input[name="name"]').type(name);
        cy.get('input[name="email"]').type(email);
        cy.get('input[name="password"]').type(password);
        cy.get('input[name="password_confirmation"]').type(password);

        cy.contains('button', 'Cadastrar').click();

});

Cypress.Commands.add('login', (email, password) => {
    cy.visit('/login');

    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type(password);

    cy.contains('button', 'Entrar').click();
});