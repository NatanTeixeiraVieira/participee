describe('Events List Page', () => {
    const random = Math.floor(Math.random() * 100000);
    const email = `test${random}@example.com`;
    const password = `Senha123${random}`;

    before(() => {
        cy.register(email, password);
    })

  beforeEach(() => {
    cy.login(email, password);
    cy.visit('/events');
  });


  it('should display the list of events', () => {
    cy.get('h1').should('contain.text', 'Lista de Eventos');

    cy.get('.card').its('length').should('be.gte', 1);

    cy.get('.card').first().within(() => {
    cy.get('.card-title').should('not.be.empty');
    cy.contains('📍 Local:').should('exist');
    cy.contains('🗓 Data:').should('exist');
    cy.contains('👤 Criado por:').should('exist');
    cy.get('.btn-success').should('exist');
    cy.get('.btn-primary').contains('Ver').should('exist');
    });
  });

  it('should allow user to join and leave an event', () => {
    cy.get('.card').first().within(() => {
      cy.get('button.btn-success').click();
    });

    cy.get('.card').first().within(() => {
      cy.get('button.btn-danger').contains('Sair').should('exist');
    });

    cy.get('.card').first().within(() => {
      cy.get('button.btn-danger').contains('Sair').click();
    });

    cy.get('.card').first().within(() => {
      cy.get('button.btn-success').contains('Participar').should('exist');
    });
  });

  it('should navigate to event detail page when clicking "Ver"', () => {
    cy.get('.card').first().within(() => {
      cy.get('a.btn-primary').contains('Ver').click();
    });

    cy.url().should('include', '/events/');
    cy.get('div.card-body')
    .find('p')
    .should('have.length', 11);
  });
});
