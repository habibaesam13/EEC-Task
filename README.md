#🧪 EEC Pharmacies
    A Laravel-based system for managing products and pharmacies, providing  MVC web interfaces , RESTful API and a clean backend architecture with optimized database queries, structured services, and scalable design.

#Database Relationships

    Product ↔ Pharmacy → Many-to-Many
    
    Pivot table stores pricing per pharmacy
    
    products
    pharmacies
    pharmacy_product (product_id, pharmacy_id, price)

