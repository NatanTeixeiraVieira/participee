describe('Create Event Page', () => {
    const random = Math.floor(Math.random() * 100000);
    const email = `test${random}@example.com`;
    const password = `Senha123${random}`;

    before(() => {
        cy.register(email, password);
    })

  beforeEach(() => {
    cy.login(email, password);
    cy.visit('/events/create');
  });

  it('should display all form fields', () => {
    cy.get('input[name="name"]').should('exist');
    cy.get('input[name="description"]').should('exist');
    cy.get('input[name="state"]').should('exist');
    cy.get('input[name="city"]').should('exist');
    cy.get('input[name="neighborhood"]').should('exist');
    cy.get('input[name="street"]').should('exist');
    cy.get('input[name="zipcode"]').should('exist');
    cy.get('input[name="number"]').should('exist');
    cy.get('input[name="complement"]').should('exist');
    cy.get('input[name="date"]').should('exist');
    cy.contains('button', 'Salvar').should('exist');
    cy.contains('a', 'Voltar').should('exist');
  });

  it('should show validation errors when submitting empty form', () => {
    cy.contains('button', 'Salvar').click();

    cy.get('.text-danger').should('have.length', 9);
  });

  it('should create a new event successfully', () => {
    const date = new Date();
    const formattedDate = date.toISOString().slice(0, 16);

    cy.get('input[name="name"]').type('Test Event');
    cy.get('input[name="description"]').type('This is a test event');
    cy.get('input[name="state"]').type('SP');
    cy.get('input[name="city"]').type('São Paulo');
    cy.get('input[name="neighborhood"]').type('Centro');
    cy.get('input[name="street"]').type('Rua teste');
    cy.get('input[name="zipcode"]').type('01001-000');
    cy.get('input[name="number"]').type('100');
    cy.get('input[name="complement"]').type('Apto 10');
    cy.get('input[name="date"]').type(formattedDate);

    cy.contains('button', 'Salvar').click();

    cy.url().should('include', '/events');
    cy.contains('Test Event').should('exist');
  });

  it('should navigate back to events list when clicking the back button', () => {
    cy.contains('a', 'Voltar').click();
    cy.url().should('include', '/events');
  });
});
