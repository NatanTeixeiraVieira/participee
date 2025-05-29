describe('Home Page - Participee', () => {
    beforeEach(() => {
        cy.visit('/');
    });

    it('Should display the main title', () => {
        cy.contains('Bem-vindo ao Sistema de Gerenciamento de Eventos').should('be.visible');
    });

    it('Should display the three information cards', () => {
        cy.contains('🎯 Objetivo').should('be.visible');
        cy.contains('🛠️ Funcionalidades').should('be.visible');
        cy.contains('🔒 Segurança').should('be.visible');
    });

    it('Should list all features inside "Funcionalidades"', () => {
        cy.contains('Cadastro de eventos com dados completos').should('be.visible');
        cy.contains('Edição e atualização em tempo real').should('be.visible');
        cy.contains('Interface responsiva e amigável').should('be.visible');
        cy.contains('Busca rápida por eventos').should('be.visible');
    });

    it('Should display the "Acessar Eventos" button with correct link', () => {
        cy.get('a.btn.btn-primary')
            .should('contain.text', 'Acessar Eventos')
            .and('have.attr', 'href')
            .then((href) => {
                expect(href).to.include('/events');
            });
    });

    it('Should navigate to login page when clicking the "Acessar Eventos" button and is not authenticated', () => {
        cy.get('a.btn.btn-primary').click();
        cy.url().should('include', '/login');
    });

    it('Should navigate to events page when clicking the "Acessar Eventos" button while authenticated', () => {
        const random = Math.floor(Math.random() * 100000);
        const email = `test${random}@example.com`;
        const password = `Senha123${random}`;
        cy.register(email, password)
        cy.login(email, password);

        cy.visit('/');
        cy.get('a.btn.btn-primary').click();
        cy.url().should('include', '/events');
    });
});
