<section class="cost-living-section">
    <div class="tuition-container">
        <div class="left">
            <h2>{{ $ukCostOfLivingRight['heading'] }}</h2>
            <p>{{ $ukCostOfLivingRight['description'] }}</p>

            <div class="tuition-box">
                @if(isset($countryWiseCost))
                    <!-- 3-Column Table (Country, Tuition Fees, Living Costs) -->
                    <h3 class="category-title">Annual Tuition Fees & Living Costs</h3>
                    <div class="tuition-table-wrapper">
                        <table class="tuition-table">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Tuition Fees (Per Year)</th>
                                    <th>Living Costs (Per Year)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countryWiseCost as $cost)
                                    <tr>
                                        <td>{{ $cost['country'] }}</td>
                                        <td>{{ $cost['tuition_fee'] }}</td>
                                        <td>{{ $cost['living_cost'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- 2-Column Table (Course Type & Tuition Fees) -->
                    <h3 class="category-title">Annual Living Expenses</h3>
                    <div class="tuition-table-wrapper">
                        <table class="tuition-table">
                            <thead>
                                <tr>
                                    <th>Expense Category</th>
                                    <th>Average Annual Cost</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($livingFees as $fee)
                                    <tr>
                                        <td>{{ $fee['label'] }}</td>
                                        <td>{{ $fee['value'] }}</td>
                                        <td>{{ $fee['note'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="right">
            <h2>{{ $ukCostOfLiving['heading'] }}</h2>
            <p>{{ $ukCostOfLiving['description'] }}</p>

            <div class="tuition-box">
                @if(isset($countryWiseCost))
                    <!-- 3-Column Table (Country, Tuition Fees, Living Costs) -->
                    <h3 class="category-title">Annual Tuition Fees & Living Costs</h3>
                    <div class="tuition-table-wrapper">
                        <table class="tuition-table">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>Tuition Fees (Per Year)</th>
                                    <th>Living Costs (Per Year)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countryWiseCost as $cost)
                                    <tr>
                                        <td>{{ $cost['country'] }}</td>
                                        <td>{{ $cost['tuition_fee'] }}</td>
                                        <td>{{ $cost['living_cost'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- 2-Column Table (Course Type & Tuition Fees) -->
                    <h3 class="category-title">Annual Tuition Fees</h3>
                    <div class="tuition-table-wrapper">
                        <table class="tuition-table">
                            <thead>
                                <tr>
                                    <th>Course Type</th>
                                    <th>Tuition Fees</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tuitionFees as $fee)
                                    <tr>
                                        <td>{{ $fee['label'] }}</td>
                                        <td>{{ $fee['value'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>

<style>
    .cost-living-section {
        background: #f9fafb;
        padding: 30px 20px;
        color: #1f2937;
        overflow-x: hidden;
    }

    .tuition-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        justify-content: space-between;
        align-items: start;
    }

    .left, .right {
        flex: 1 1 48%;
        min-width: 300px;
    }

    .tuition-box {
        background-color: #fff;
        border-radius: 12px;
        padding: 25px 30px;
        margin-top: 25px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
        width: 100%;
        transition: all 0.3s ease;
    }

    .tuition-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .category-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #1e293b;
        text-align: center;
    }

    .tuition-table-wrapper {
        overflow-x: auto;
    }

    .tuition-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
        min-width: 300px;
    }

    .tuition-table th,
    .tuition-table td {
        text-align: left;
        padding: 12px 15px;
        border-bottom: 1px solid #e5e7eb;
        word-break: break-word;
    }

    .tuition-table th {
        background-color: #f3f4f6;
        font-weight: 600;
        color: #1f2937;
    }

    .tuition-table tr:nth-child(even) {
        background-color: #f9fafb;
    }

    .tuition-table td {
        color: #374151;
    }

    .info-highlight {
        margin-top: 25px;
        background: #fff8e1;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #fbbf24;
        font-size: 15px;
        color: #1f2937;
        animation: fadeIn 0.6s ease;
    }

    .info-highlight p {
        font-size: 0.9rem;
        margin: 0 0 10px 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .tuition-box {
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .tuition-container {
            flex-direction: column;
            gap: 60px;
        }

        .left,
        .right {
            flex: 1 1 100%;
        }

        .category-title {
            font-size: 16px;
        }

        .info-highlight {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {

        .tuition-box {
            padding: 15px;
        }

        .tuition-table th,
        .tuition-table td {
            padding: 10px 8px;
            font-size: 14px;
        }

        .info-highlight {
            padding: 15px;
        }
    }

    @media (max-width: 320px) {
        .cost-living-section {
            padding: 30px 15px;
        }

        .info-highlight {
            padding: 12px;
            font-size: 13px;
            width: 95%;
        }

        .info-highlight p {
            font-size: 0.75rem;
        }

        .tuition-box {
            padding: 12px;
            width: 95%;
            margin: auto;
        }

        .tuition-table th,
        .tuition-table td {
            padding: 8px 6px;
            font-size: 13px;
        }

        .category-title {
            font-size: 15px;
        }
    }
</style>
