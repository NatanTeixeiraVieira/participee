describe('User Registration Page', () => {
  beforeEach(() => {
    cy.visit('/register');
  });

  it('should display all form fields', () => {
    cy.get('input[name="name"]').should('exist');
    cy.get('input[name="email"]').should('exist');
    cy.get('input[name="password"]').should('exist');
    cy.get('input[name="password_confirmation"]').should('exist');
    cy.contains('button', 'Cadastrar').should('exist');
    cy.contains('a', 'Já tem conta? Entrar').should('exist');
  });

  it('should show validation errors if form is submitted empty', () => {
    cy.contains('button', 'Cadastrar').click();

    cy.get('.invalid-feedback').should('contain', 'O nome é obrigatório');
    cy.get('.invalid-feedback').should('contain', 'O email é obrigatório');
    cy.get('.invalid-feedback').should('contain', 'A senha é obrigatória');
  });

  it('should show error if password confirmation does not match', () => {
    cy.get('input[name="name"]').type('Test User');
    cy.get('input[name="email"]').type('test@example.com');
    cy.get('input[name="password"]').type('password123');
    cy.get('input[name="password_confirmation"]').type('different');

    cy.contains('button', 'Cadastrar').click();

    cy.get('.invalid-feedback').should('contain', 'A confirmação da senha não confere');
  });

  it('should show error if email already exists', () => {
    const email = `test@email${new Date().getTime()}.com`

    cy.get('input[name="name"]').type('Test User');
    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type('password123');
    cy.get('input[name="password_confirmation"]').type('password123');
    cy.contains('button', 'Cadastrar').click();

    cy.visit('/register');

    cy.get('input[name="name"]').type('Test User');
    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type('password123');
    cy.get('input[name="password_confirmation"]').type('password123');

    cy.contains('button', 'Cadastrar').click();

    cy.get('.invalid-feedback').should('contain', 'Este email já está em uso');
  });



  it('should register successfully with valid credentials', () => {
    const random = Math.floor(Math.random() * 100000);
    const email = `test${random}@example.com`;

    cy.get('input[name="name"]').type('Test User');
    cy.get('input[name="email"]').type(email);
    cy.get('input[name="password"]').type('password123');
    cy.get('input[name="password_confirmation"]').type('password123');

    cy.contains('button', 'Cadastrar').click();

    cy.url().should('not.include', '/register');
    cy.contains('Logout').should('exist');
  });

  it('should navigate to login page when clicking the login link', () => {
    cy.contains('Já tem conta? Entrar').click();
    cy.url().should('include', '/login');
  });
});
